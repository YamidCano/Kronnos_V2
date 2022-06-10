<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectComponent extends Component
{

    public $options;
    public $title;
    public $dataid;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options, $dataid = null, $title = null)
    {
        $this->options = $options;
        $this->title = $title;
        $this->dataid = $dataid;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-component');
    }
}
