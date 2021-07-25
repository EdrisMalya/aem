<?php

namespace App\View\Components;

use Illuminate\View\Component;

class datatable extends Component
{
    public $buttons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($buttons=false)
    {
        //
        $this->buttons = $buttons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.datatable');
    }
}
