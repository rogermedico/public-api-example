<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Component;
use function view;

class Table extends Component
{

    /**
     * The table model
     *
     * @var string
     */
    public $tableName;

    /**
     * The table columns
     *
     * @var string[]
     */
    public $tableColumns;

    /**
     * The table data
     *
     * @var mixed
     */
    public $tableData;

    /**
     * Table description
     *
     * @var string
     */
    public $hint;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model, Collection $tableData, string $hint)
    {
        $this->tableName = $model->getTable();

        //$this->tableColumns = Schema::getColumnListing($model->getTable());

        $tableColumns = DB::select('show columns from ' . $model->getTable());

        $this->tableColumns = array_map(function($db_column) {
            return $db_column->Field;
        }, $tableColumns);

        $this->tableData = $tableData->toArray();
        $this->hint = $hint;
        foreach ($this->tableData as $rowKey => $row)
        {
            foreach ($row as $elementKey => $element)
            {
                if (strlen($element) > 6 && strtotime($element))
                {
                    $dateTime = Carbon::createFromTimestamp(strtotime($element));
                    if($dateTime->hour === 0 && $dateTime->minute === 0 && $dateTime->second === 0)
                    {
                        $this->tableData[$rowKey][$elementKey] = $dateTime->format('d/m/Y');
                    }
                    else{
                        $this->tableData[$rowKey][$elementKey] = $dateTime->format('d/m/Y H:i:s');
                    }
                }
            }
        }

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
