<?php

namespace App\Http\Livewire;

use App\Models\MyWork;
use Livewire\Component;
use Livewire\WithPagination;
use DB;

class Report extends Component
{
    use WithPagination;
    public $show_task_details=false;
    public $task_id;
    public $completed_tasks;

    public function mount()
    {
        $this->completed_tasks = DB::table('my_works')
            ->selectRaw("
                year, month, title, description,

                row_number() over (partition by year order by year) year_number,
                row_number() over (partition by year, month order by year) month_number,

                count(1) over (partition by year) as year_rowspan,
                count(1) over (partition by year, month) as month_rowspan
            ")
            ->groupBy('year', 'month', 'title', 'description')
            ->orderBy('year')
            ->orderBy('year_number')
            ->orderBy('month')
            ->orderBy('month_number')
            ->where('status','=','completed')
            ->get();
    }
    public function taskDetails($id)
    {
        $this->task_id = $id;
        $this->show_task_details = true;
    }
    public function render()
    {
        return view('livewire.report');
    }
}
