<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Helper;
use App\Models\MyWork;
use App\Models\MyWorkFiles;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyWorkDetails extends Component
{
    use WithFileUploads;
    public $task;
    public $edit_mode=false;
    public $showDeleteModal=false;
    public $showFileDeleteModal=false;
    public $description;
    public $file;
    public $files=[];
    public $addSubTask = false;
    public $parent_task = null;
    public $user_id;

    protected $listeners = ['subTaskAdded'];

    public function mount(MyWork $id){
        $this->task = $id;
        $this->user_id = $id->user_id;
    }

    public function previousTask()
    {
        $this->task = $this->parent_task;
        if ($this->task->my_work_id!=null){
            $this->parent_task = MyWork::find($this->task->my_work_id);
        }else{
            $this->parent_task = null;
        }
    }

    public function subTaskAdded(MyWork $parent_task)
    {
        $this->task = $parent_task;
        $this->addSubTask = false;
    }
    public function moveToRunning()
    {
        $this->task->update([
            'status' => 'running'
        ]);
        $this->tasks = auth()->user()->tasks;
        $this->task_details = false;
        if ($this->parent_task!=null){
            $this->task = $this->parent_task;
        }else{
            $this->emitUp('closeForm');
        }
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Moved to running status',
            'classes' => 'green rounded'
        ]);
    }

    public function taskDetails(MyWork $task, MyWork $parent_task)
    {
        $this->addSubTask = false;
        $this->task = $task;
        $this->parent_task = $parent_task;
    }

    public function findParent($id)
    {
        if ($id!=null){
            return MyWork::find($id);
        }
    }

    public function test()
    {
        return 'test';
    }

    public function deleteFile(MyWorkFiles $file)
    {
        $this->file = $file;
        $this->showFileDeleteModal = true;
    }

    public function deleteFileAction(MyWork $task)
    {
        Helper::deleteFile($this->file->file);
        $this->file->delete();
        $this->task = $task;
        $this->showFileDeleteModal = false;
        $this->edit_mode = false;
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Deleted successfully',
            'classes' => 'green rounded'
        ]);
    }
    public function moveToUpcoming()
    {
        $this->task->update([
            'status' => 'upcoming'
        ]);
        $this->tasks = auth()->user()->tasks;
        $this->task_details = false;
        if ($this->parent_task!=null){
            $this->task = $this->parent_task;
        }else{
            $this->emitUp('closeForm');
        }
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Moved to upcoming status',
            'classes' => 'green rounded'
        ]);
    }

    public function saveFiles(MyWork $task)
    {
        if (count($this->files) > 0){
            foreach ($this->files as $file){
                MyWorkFiles::create([
                    'my_work_id' => $task->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_ext' => $file->getClientOriginalExtension(),
                    'file' => $file->store('my_work_files','public'),
                ]);
            }
            $this->task = $task;
            $this->edit_mode = false;
        }
    }
    public function moveToCompleted()
    {
        $this->task->update([
            'status' => 'completed'
        ]);
        $this->tasks = auth()->user()->tasks;
        $this->task_details = false;
        if ($this->parent_task!=null){
            $this->task = $this->parent_task;
        }else{
            $this->emitUp('closeForm');
        }
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Moved to completed status',
            'classes' => 'green rounded'
        ]);
    }

    public function saveDescription()
    {
        $this->validate(['description'=>'required']);
        $this->task->update([
            'description' => $this->description
        ]);
        $this->edit_mode = false;
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Updated successfully',
            'classes' => 'green rounded'
        ]);
    }


    public function delete()
    {
        if ($this->parent_task!=null){
            $task = MyWork::find($this->task->id);
            foreach ($task->files as $file){
                Helper::deleteFile($file->file);
                $file->delete();
            }
            $task->delete();
            $this->task = MyWork::find($this->parent_task->id);
            if ($this->task->my_work_id!=null){
                $this->parent_task = MyWork::find($this->task->id);
            }else{
                $this->parent_task = null;
            }
            $this->showDeleteModal = false;
        }else{
            $this->emitUp('deleteTask',$this->task->id);
        }
    }
    public function closeForm()
    {
        $this->emitUp('closeForm');
    }
    public function render()
    {
        return view('livewire.my-work-details');
    }
}
