<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * If input field is disabled.
     *
     * @return bool
     */
    public bool $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.input');
    }
}
