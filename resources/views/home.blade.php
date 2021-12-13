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
        <section class="mb-3">
            <h1>{{__('api documentation')}}</h1>
            <div class="ps-3">
                <p>
                    Documentation done with <a href="https://swagger.io/" alt="Swagger">Swagger</a> using the composer packet <a href="https://github.com/DarkaOnLine/L5-Swagger" alt="DarkaOnLine/L5-Swagger">darkaonline/l5-swagger</a>.

                </p>
                <div class="text-center text-md-start">
                    <a class="btn btn-primary" href="{{url('api/documentation')}}">Open documentation</a>
                </div>
            </div>
        </section>
        <section class="mb-3">
            <h1>{{__('your authentication key')}}</h1>
            <div class="ps-3">
                <div class="alert alert-success text-center font-monospace authentication-key">
                    5f4dcc3b5aa765d61d8327deb882cf99
                </div>
            </div>
        </section>
        <section class="mb-3">
            <h1>{{__('db content')}}</h1>
            <div class="ps-3">
                @foreach($db as $table)
                    <x-table
                        :model="$table->model"
                        :table-data="$table->data"
                        :hint="$table->hint"
                    />
                @endforeach
            </div>
        </section>
    </main>
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
</body>
</html>
