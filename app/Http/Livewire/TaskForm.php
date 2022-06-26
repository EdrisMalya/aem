<?php

namespace App\Http\Livewire;

use App\Models\MyWork;
use App\Models\MyWorkFiles;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class TaskForm extends Component
{
    use WithFileUploads;
    public $status;
    public $description;
    public $start_date;
    public $title;
    public $end_date;
    public $files = [];
    public $upcomingStatus=false;
    public $runningStatus=false;
    public $completedStatus=false;
    public $work_id;
    public $parent_task;
    public $showFormFields=false;
    public $user_id;
    public $fromManager=false;

    protected $rules = ['status'=>'required'];

    public function mount($task_id=0,$user_id=0)
    {
        if ($task_id!=0){
            $this->parent_task = $task_id;
        }
        $this->start_date = date('Y-m-d');
        $this->end_date = date('Y-m-d',strtotime('+1 month'));
        if ($user_id!=0){
            $this->user_id = $user_id;
            $this->fromManager = true;
        }else{
            $this->user_id = auth()->id();
            $this->fromManager = false;
        }
    }
    public function closeForm()
    {
        $this->emitUp('closeForm');
    }

    public function updatedStatus()
    {
        $this->showFormFields = true;
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required'
        ]);
    }

    public function save()
    {
        $this->validate([
            'title'=>['required','string','min:3'],
            'status'=>'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $this->create();
        $this->dispatchBrowserEvent('notify',[
            'message' => 'Saved successfully',
            'classes' => 'green rounded'
        ]);
        if ($this->parent_task!=0){
            $this->emitUp('subTaskAdded',$this->parent_task);
            $this->parent_task = 0;
        }else{
            $this->emitUp('closeForm');
        }
    }

    public function create()
    {
        $obj = MyWork::create([
            'status' => $this->status,
            'title' => $this->title,
            'my_work_id' => ($this->parent_task!=0?$this->parent_task:null),
            'user_id' => $this->user_id,
            'from_user_id' => $this->fromManager?auth()->id():0,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'expire_date' => $this->end_date,
            'year' => date('Y'),
            'month' => date('m'),
            'day' => date('d'),
        ]);
        if (count($this->files) > 0 ){
            foreach ($this->files as $file){
                MyWorkFiles::create([
                    'my_work_id' => $obj->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_ext' => $file->getClientOriginalExtension(),
                    'file' => $file->store('my_work_files','public'),
                ]);
            }
        }
    }
    public function render()
    {
        return view('livewire.task-form');
    }
}
