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
            <h1>{{__('your authentication key')}}</h1>
            <div class="ps-3">
                <p>
                    This authentication token allows you to retrieve (GET) and create (POST) DB records as you please, but you can just modify (PUT) or
                    delete (DELETE) records created with the same authentication token. The column <code>token_id</code> from the DB tables shows the id from the token used
                    to create the record.
                </p>
                <p>The authentication is made with a Bearer token. To correctly authenticate your requests a header entry
                    specifying the authentication of the request should be added. To quickly allow you to identify your records the
                    id of the key is the first number, so if your key starts with a 12 the records that his <code>token_id</code> is equal
                    to 12 are your records, and you are allowed to modify or delete.
                </p>
                <p>An example of the authentication header that has to be included in every request could be as follows
                    <code>Authorization: Bearer @{{token provided}}</code></p>
                <p>Tokens will be valid for 24 hours.</p>
                <div class="text-center">
                    <div class="d-sm-none table-responsive">
                    <table class="table table-borderless mt-2">
                        <tr><td>
                    <span id="token" class="alert alert-success text-center font-monospace authentication-key">{{$api_token}}</span>
                            </td></tr></table></div>
                    <span id="token" class="d-none d-sm-inline alert alert-success text-center font-monospace authentication-key">{{$api_token}}</span>
                    <a href="#" id="copy-clipboard" class="ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard" alt="Copy to clipboard">
                        <x-heroicon-o-clipboard-copy class="icon"/>
                    </a>
                </div>
            </div>
        </section>
        <section class="mb-3">
            <h1>{{__('api documentation')}}</h1>
            <div class="ps-3">
                <p>
                    Documentation done with <a href="https://swagger.io/" alt="Swagger">Swagger</a> using the composer
                    packet <a href="https://github.com/DarkaOnLine/L5-Swagger" alt="DarkaOnLine/L5-Swagger">darkaonline/l5-swagger</a>.
                </p>
                <div class="text-center text-md-start">
                    <a class="btn btn-primary" href="{{url('api/documentation')}}">Open documentation</a>
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
