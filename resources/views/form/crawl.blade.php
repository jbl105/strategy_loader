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
                background-color: #fff;
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

            .scrollable{
                overflow: scroll;
            }

            table{
                margin-top: 30px;
                width: 100%;
                text-align: left;
                border: 1px solid #ccc;
                margin: 20px 0;
            }

            table tr td{
                border: 1px solid #ccc;
                padding: 5px;
            }            

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
                padding: 10px;
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
                overflow: hidden;
            }

            .title {
                font-size: 84px;
            }

            .text-left{
                text-align: left;
            }

            .text-left p{
                text-overflow: ellipsis;
                overflow: hidden;
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

            input[type=checkbox] + form, input[type=checkbox] + table{
                display: none;
            }

            input[type=checkbox]:checked + form, input[type=checkbox] + table{
                display: block;
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
                    <h1 class="title">Crawl data</h1>
                    <a href="{{ url('/') }}">Back</a>
                    <div class="text-left">
                        <p><strong>Name:</strong> {{ $type->name }}</p>
                        <p><strong>Slug:</strong> {{ $type->slug }}</p>
                        <p><strong>Link:</strong> <a href="{{ $type->link }}" target="_blank">Click here</a></p>
                    </div>
                    <hr>
                    <h2><label for="toggle_portfolio_statistics">Portfolio Statistics</label></h2>
                    <input type="checkbox" hidden id="toggle_portfolio_statistics">     
                    <form method="POST">
                        {{ csrf_field() }}
                        <div id="portfolio_statistics">
                            @if(!count($portfolio_statistics))
                            <input type="submit" value="Start Crawl Portfolio Statistics" name="portfolio_statistics">
                            @else
                            <input type="submit" value="Re-Crawl Portfolio Statistics" name="portfolio_statistics">
                            <table>
                                <tr>
                                    @foreach($portfolio_statistic_keys as $key)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>
                                @foreach($portfolio_statistics as $item)
                                <tr>
                                    @foreach($item as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </table>                            
                            @endif
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_metrics">Metrics</label></h2>
                    <input type="checkbox" hidden id="toggle_metrics">   
                    <form method="POST">
                        {{ csrf_field() }}
                        <div id="metrics">
                            @if(!count($metrics))
                            <input type="submit" value="Start Crawl Metrics" name="metrics">
                            @else
                            <input type="submit" value="Re-Crawl Metrics" name="metrics">
                            <table>
                                <tr>
                                    @foreach($metric_keys as $key)
                                        <th>{{ $key }}</th>
                                    @endforeach
                                </tr>
                                @foreach($metrics as $item)
                                <tr>
                                    @foreach($item as $value)
                                        <td>{{ $value }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </table>                            
                            @endif
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_annual_returns">Annual Returns</label></h2>
                    <input type="checkbox" hidden id="toggle_annual_returns"> 
                    <form method="POST">
                        {{ csrf_field() }}
                        <div id="annual_returns">
                            @if(!count($annual_returns))
                            <input type="submit" value="Start Crawl Annual Returns" name="annual_returns">
                            @else
                            <input type="submit" value="Re-Crawl Annual Returns" name="annual_returns">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        @foreach($annual_returns_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($annual_returns as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div>                            
                            @endif
                        </div>
                    </form>
                    <hr>    
                    <h2><label for="toggle_monthly_returns">Monthly Returns</label></h2>
                    <input type="checkbox" hidden id="toggle_monthly_returns">
                    <form method="POST">
                        {{ csrf_field() }}                        
                        <div id="monthly_returns">
                            @if(!count($monthly_returns))
                            <input type="submit" value="Start Crawl Monthly Returns" name="monthly_returns">
                            @else
                            <input type="submit" value="Re-Crawl Monthly Returns" name="monthly_returns">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        @foreach($monthly_returns_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($monthly_returns as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div>                            
                            @endif
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_drawdowns">Drawdowns</label></h2>
                    <input type="checkbox" hidden id="toggle_drawdowns">
                    <form method="POST">
                        {{ csrf_field() }}                        
                        <div id="toggle_drawdowns">
                            @if(!count($drawdowns_timing_portfolio) && !count($drawdowns_equal_weight_portfolio) && !count($drawdowns_vanguard_500_index_fund))
                            <input type="submit" value="Start Crawl Drawdowns" name="drawdowns">
                            @else
                            <input type="submit" value="Re-Crawl Drawdowns" name="drawdowns">
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_timing_portfolio">Drawdowns for Timing Portfolio</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_timing_portfolio">
                                <table>
                                    <tr>
                                        @foreach($drawdowns_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($drawdowns_timing_portfolio as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ nl2br($value) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div> 
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_equal_weight_portfolio">Drawdowns for Equal Weight Portfolio</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_equal_weight_portfolio">
                                <table>
                                    <tr>
                                        @foreach($drawdowns_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($drawdowns_equal_weight_portfolio as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ nl2br($value) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div> 
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_vanguard_500_index_fund">Drawdowns for Vanguard 500 Index Fund</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_vanguard_500_index_fund">
                                <table>
                                    <tr>
                                        @foreach($drawdowns_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($drawdowns_vanguard_500_index_fund as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ nl2br($value) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div>                            
                            @endif
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_timing_periods">Timing Periods</label></h2>
                    <input type="checkbox" hidden id="toggle_timing_periods">
                    <form method="POST">
                        {{ csrf_field() }}                        
                        <div id="timing_periods">
                            @if(!count($timing_periods))
                            <input type="submit" value="Start Crawl Timing Periods" name="timing_periods">
                            @else
                            <input type="submit" value="Re-Crawl Timing Periods" name="timing_periods">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        @foreach($timing_periods_keys as $key)
                                            <th>{{ $key }}</th>
                                        @endforeach
                                    </tr>
                                    @foreach($timing_periods as $item)
                                    <tr>
                                        @foreach($item as $value)
                                            <td>{{ nl2br($value) }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </table>
                            </div>                            
                            @endif
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </body>
</html>
