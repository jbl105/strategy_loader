<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
       link     background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;                
                margin: 0;
            }

            input{
                padding: 10px;
                -webkit-appearance: initial;
                border: 1px solid #000;
                background: none;
                width: 300px;
            }

            table{
                margin-top: 30px;
                width: 100%;
                text-align: left;
                border: 1px solid #ccc;
            }

            table tr td{
                border: 1px solid #ccc;
                padding: 5px;
                max-width: 200px;
                text-overflow: ellipsis;
                overflow: hidden;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="m-b-md">
                    <h1 class="title">Create new type</h1>
                    <div class="status"><strong>{{ session('status') }}</strong></div>
                    <form method="POST">
                        {{ csrf_field() }}
                        <div>
                            <input type="text" name="name" placeholder="Name" required>
                            <p>
                            @if($errors->has('name'))
                                {{ $errors->first('name') }}
                            @endif
                            </p>
                        </div>
                        <div>
                            <input type="text" name="slug" placeholder="Slug">
                            <p>
                            @if($errors->has('slug'))
                                {{ $errors->first('slug') }}
                            @endif
                            </p>
                        </div>
                        <div>
                            <input type="url" name="link" placeholder="Link">
                            <p>
                            @if($errors->has('link'))
                                {{ $errors->first('link') }}
                            @endif
                            </p>
                        </div>
                        <input type="submit" value="Create">
                    </form>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Link</th>
                            <th>Control</th>
                        </tr>
                        @foreach($types as $type)
                        <tr>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->slug }}</td>
                            <td>{{ $type->link }}</td>
                            <td><a href="{{ url('/crawl/' . $type->slug) }}">Crawl data</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>                
            </div>
        </div>
    </body>
</html>
