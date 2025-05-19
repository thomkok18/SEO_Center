<?php

namespace App\View\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * The id used in the modal.
     *
     * @return string
     */
    public string $id;

    /**
     * The title used in the modal.
     *
     * @return string
     */
    public string $title;

    /**
     * The description used in the modal.
     *
     * @return string
     */
    public string $description;

    /**
     * The route used in the form of the modal.
     *
     * @return string
     */
    public string $route;

    /**
     * The method used in the form of the modal.
     *
     * @return string
     */
    public string $method;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $title, string $description, string $route, string $method = '')
    {
        $this->title = $title;
        $this->id = $id;
        $this->description = $description;
        $this->route = $route;
        $this->method = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('components.modal');
    }
}
