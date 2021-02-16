<?php

namespace Modules\Admin\View;

use Illuminate\View\Component;

class BreadcrumbItem extends Component
{

    public $url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($url = "#")
    {
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('admin::components.breadcrumb-item');
    }
}
