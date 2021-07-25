<?php

namespace App\View\Components;

use Illuminate\View\Component;

class layout extends Component
{
    public $title;
    public $active;
    public function __construct($title,$active)
    {
        $this->title = $title;
        $this->active = $active;
    }
    public function render()
    {
        return view('layouts.layout');
    }

}
