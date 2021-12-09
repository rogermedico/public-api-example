<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use function view;

class table extends Component
{

    /**
     * The table model
     *
     * @var Model
     */
    public $model;

    /**
     * The table data
     *
     * @var Collection
     */
    public $tableData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model, Collection $tableData)
    {
        $this->model = $model;
        $this->tableData = $tableData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
