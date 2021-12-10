<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public API</title>
    <meta name="description" content="{{__('Public API Example')}}">
    <meta name="keywords" content="laravel api">
    <meta name="author" content="Roger Medico">
    <link rel="icon" type="image/png" href="{{asset('storage/favicon/favicon.ico')}}">
    <!-- Styles -->
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="container">
        <section>
            <h1 class="text-center text-md-start">{{__('public api')}}</h1>
            @foreach($routes as $route)
                <p>{{implode('|',$route->methods)}}{{$route->uri}}</p>
            @endforeach
        </section>
        <section>
            <h1 class="text-center text-md-start">{{__('db content')}}</h1>
                @foreach($db as $table)
                    <x-table
                        :model="$table->model"
                        :table-data="$table->data"
                        :hint="$table->hint"
                    />
                @endforeach
        </section>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</body>
</html>
