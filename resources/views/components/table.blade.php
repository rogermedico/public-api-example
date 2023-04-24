<h2>{{__('table:')}} {{$tableName}}</h2>
@isset($hint)
    <p class="mb-2">{{$hint}}</p>
@endif
<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                @foreach($tableColumns as $column)
                    <th scope="col">{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($tableData as $row)
                <tr>
                    @foreach($row as $value)
                        @if($loop->first)
                            <th scope="row">
                                {{$value}}
                            </th>
                        @else
                            <td>
                                {{$value}}
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
