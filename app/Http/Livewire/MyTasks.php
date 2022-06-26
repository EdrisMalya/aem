<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Helper;
use App\Models\MyWork;
use App\Models\User;
use Livewire\Component;

class MyTasks extends Component
{
    public $tasks;
    public $form = false;
    public $task;
    public $task_details = false;
    public $deleteModel = false;
    public $user_id;
    public $upcoming_tasks =[];
    public $running_tasks =[];
    public $completed_tasks =[];


    protected $listeners = ['refreshChildren','closeForm','deleteTask'];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->refresh();
    }

    public function refreshChildren()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->tasks = MyWork::where('user_id','=',$this->user_id)->get();
        $this->upcoming_tasks = MyWork::where('user_id','=',$this->user_id)->where('status','=','upcoming')->where('my_work_id','=',null)->get();
        $this->running_tasks = MyWork::where('user_id','=',$this->user_id)->where('status','=','running')->where('my_work_id','=',null)->get();
        $this->completed_tasks = MyWork::where('user_id','=',$this->user_id)->where('status','=','completed')->where('my_work_id','=',null)->get();
    }

    public function deleteTask(MyWork $task)
    {
        if ($task->files->count() > 0) {
            foreach ($this->task->files as $file){
                Helper::deleteFile($file->file);
                $file->delete();
            }
        }
        $task->delete();
        $check_children = MyWork::where('my_work_id','=',$task->id)->get();
        if (count($check_children) > 0){
            foreach ($check_children as $task){
                $this->deleteTask($task);
            }
        }
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Deleted successfully',
            'classes' => 'green rounded'
        ]);
        $this->task = null;
        $this->task_details = false;
        $this->refresh();
    }

    public function closeForm()
    {
        $this->task_details = false;
    }

    public function taskDetails($id)
    {
        $this->task = MyWork::find($id);
        $this->task_details = true;
    }

    public function ShowDeleteModal()
    {
        $this->deleteModel = true;
        $this->task_details = false;
    }
    public function render()
    {
        return view('livewire.my-tasks',[
            'tasks' => $this->tasks
        ]);
    }
}
