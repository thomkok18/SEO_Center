<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * If link is active.
     *
     * @return bool
     */
    public bool $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $active = false)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.nav-link');
    }
}
