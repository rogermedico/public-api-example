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
            <h1>{{__('authentication key')}}</h1>
            <div class="ps-3">
                <p>{{__('The authentication of the API calls is made with a Bearer token. To authenticate your requests a header entry
                    specifying the authentication of the request should be added. To quickly allow you to identify your records each token has an id which is
                    the first number before the pipe, so if your key starts with 12 the records that his')}} <code>token_id</code> {{__('is equal
                    to 12 are your records.')}}
                </p>
                <p>
                    {{__('All tokens allow the users to retrieve (GET) and create (POST) db records as you please, but you only can modify (PUT) or
                    delete (DELETE) records created with the same authentication token that is used to make the call. The column')}} <code>token_id</code> {{__('of the db tables shows the id of the token used
                    to create the record.')}}
                </p>
                <p>{{__('The endpoint of the API is')}} <code>https://public-api.rmedico.com/api</code>. {{__('Remember that requests to the API also has to
                    include the')}} <code>Accept: application/json</code> {{__('header')}} {{__('and the authentication header that, in this case, looks like this:')}}
                    <code>Authorization: Bearer @{{token provided}}</code>. {{__('Tokens will be valid for 24 hours.')}}
                </p>
                <div class="text-center">
                    <div class="py-3">
                    <span id="token" class="alert alert-success text-center font-monospace authentication-key">{{$api_token}}</span>
                    </div>
                    <div class="pt-3">
                    <button id="copy-clipboard" class="btn btn-primary">{{__('Copy to clipboard')}}</button>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-3">
            <h1>{{__('api documentation')}}</h1>
            <div class="ps-3">
                <p>
                    {{__('The documentation of the API is where you can see all endpoints and how to interact with everyone of them')}}. {{__('The documentation was made with')}} <a href="https://swagger.io/" alt="Swagger">Swagger</a> {{__('using the composer package')}}
                    <a href="https://github.com/DarkaOnLine/L5-Swagger" alt="DarkaOnLine/L5-Swagger">darkaonline/l5-swagger</a>. {{__('This kind of documentation allows you to authenticate yourself with the provided token and to make real API calls. Then the changes that you make to the db can be seen in the below db content section.')}}
                </p>
                <div class="text-center">
                    <a class="btn btn-primary" href="{{url('api/documentation')}}">{{__('Open documentation')}}</a>
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
