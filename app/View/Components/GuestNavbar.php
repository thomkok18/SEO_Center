<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestNavbar extends Component
{
    /**
     * The page name.
     *
     * @var string
     */
    public string $namePage;

    /**
     * The active page name.
     *
     * @var string
     */
    public string $activePage;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $activePage, string $namePage = '')
    {
        $this->namePage = $namePage;
        $this->activePage = $activePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.guest-navbar');
    }
}
