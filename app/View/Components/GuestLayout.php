<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
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
     * The css file location.
     *
     * @var string
     */
    public string $css;

    /**
     * If font awesome css is needed.
     *
     * @var boolean
     */
    public bool $fontAwesome;

    /**
     * The description.
     *
     * @var string
     */
    public string $class;

    /**
     * The background image of a page.
     *
     * @var string
     */
    public string $backgroundImage;

    /**
     * Create a new component instance.
     *
     * @param string $activePage
     * @param string $css
     * @param bool $fontAwesome
     * @param string $namePage
     * @param string $class
     * @param string $backgroundImage
     */
    public function __construct(string $activePage, string $css, bool $fontAwesome, string $namePage = '', string $class = '', string $backgroundImage = '')
    {
        $this->namePage = $namePage;
        $this->activePage = $activePage;
        $this->css = $css;
        $this->fontAwesome = $fontAwesome;
        $this->class = $class;
        $this->backgroundImage = $backgroundImage;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
