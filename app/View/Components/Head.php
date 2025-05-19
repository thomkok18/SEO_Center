<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Head extends Component
{
    /**
     * The title.
     *
     * @var string
     */
    public string $title;

    /**
     * The description.
     *
     * @var string
     */
    public string $description;

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
     * Create a new component instance.
     *
     * @param string $title
     * @param string $description
     * @param string $css
     * @param bool $fontAwesome
     */
    public function __construct(string $title, string $description, string $css, bool $fontAwesome)
    {
        $this->title = $title;
        $this->description = $description;
        $this->css = $css;
        $this->fontAwesome = $fontAwesome;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.head');
    }
}
