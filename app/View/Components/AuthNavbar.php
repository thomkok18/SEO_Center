<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AuthNavbar extends Component
{
    /**
     * The page name.
     *
     * @var string
     */
    public string $namePage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $namePage = '')
    {
        $this->namePage = $namePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.auth-navbar');
    }
}
