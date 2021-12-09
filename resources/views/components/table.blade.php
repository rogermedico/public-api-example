<h2>{{$model->getTable()}}</h2>
@if(method_exists($model,'getHelper'))
    <p>{{$model->getHelper()}}</p>
@endif
<table class="table table-striped">
    <thead>
        <tr>
            @foreach($model->getFillable() as $column)
                <th scope="col">{{$column}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($tableData->toArray() as $row)
            <tr>
                @foreach($row as $key => $value)
                    <td>
                        {{$value}}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
