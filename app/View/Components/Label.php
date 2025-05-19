<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Label extends Component
{
    /**
     * If label has a value.
     *
     */
    public ?string $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $value = null)
    {
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.label');
    }
}
