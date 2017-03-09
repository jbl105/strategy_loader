<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
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
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(Auth::check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(url('/login')); ?>">Login</a>
                        <a href="<?php echo e(url('/register')); ?>">Register</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="m-b-md">
                    <h1 class="title">Crawl data</h1>
                    <a href="<?php echo e(url('/')); ?>">Back</a>
                    <div class="text-left">
                        <p><strong>Name:</strong> <?php echo e($type->name); ?></p>
                        <p><strong>Slug:</strong> <?php echo e($type->slug); ?></p>
                        <p><strong>Link:</strong> <a href="<?php echo e($type->link); ?>" target="_blank">Click here</a></p>
                    </div>
                    <hr>
                    <h2><label for="toggle_portfolio_statistics">Portfolio Statistics</label></h2>
                    <input type="checkbox" hidden id="toggle_portfolio_statistics">     
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div id="portfolio_statistics">
                            <?php if(!count($portfolio_statistics)): ?>
                            <input type="submit" value="Start Crawl Portfolio Statistics" name="portfolio_statistics">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Portfolio Statistics" name="portfolio_statistics">
                            <table>
                                <tr>
                                    <?php $__currentLoopData = $portfolio_statistic_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($key); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <?php $__currentLoopData = $portfolio_statistics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($value); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>                            
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_metrics">Metrics</label></h2>
                    <input type="checkbox" hidden id="toggle_metrics">   
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div id="metrics">
                            <?php if(!count($metrics)): ?>
                            <input type="submit" value="Start Crawl Metrics" name="metrics">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Metrics" name="metrics">
                            <table>
                                <tr>
                                    <?php $__currentLoopData = $metric_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($key); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <?php $__currentLoopData = $metrics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e($value); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>                            
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_annual_returns">Annual Returns</label></h2>
                    <input type="checkbox" hidden id="toggle_annual_returns"> 
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div id="annual_returns">
                            <?php if(!count($annual_returns)): ?>
                            <input type="submit" value="Start Crawl Annual Returns" name="annual_returns">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Annual Returns" name="annual_returns">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $annual_returns_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $annual_returns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($value); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>                            
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>    
                    <h2><label for="toggle_monthly_returns">Monthly Returns</label></h2>
                    <input type="checkbox" hidden id="toggle_monthly_returns">
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>                        
                        <div id="monthly_returns">
                            <?php if(!count($monthly_returns)): ?>
                            <input type="submit" value="Start Crawl Monthly Returns" name="monthly_returns">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Monthly Returns" name="monthly_returns">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $monthly_returns_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $monthly_returns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($value); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>                            
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_drawdowns">Drawdowns</label></h2>
                    <input type="checkbox" hidden id="toggle_drawdowns">
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>                        
                        <div id="toggle_drawdowns">
                            <?php if(!count($drawdowns_timing_portfolio) && !count($drawdowns_equal_weight_portfolio) && !count($drawdowns_vanguard_500_index_fund)): ?>
                            <input type="submit" value="Start Crawl Drawdowns" name="drawdowns">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Drawdowns" name="drawdowns">
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_timing_portfolio">Drawdowns for Timing Portfolio</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_timing_portfolio">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $drawdowns_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $drawdowns_timing_portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(nl2br($value)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div> 
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_equal_weight_portfolio">Drawdowns for Equal Weight Portfolio</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_equal_weight_portfolio">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $drawdowns_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $drawdowns_equal_weight_portfolio; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(nl2br($value)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div> 
                            <div class="scrollable">
                                <h2><label for="toggle_drawdowns_vanguard_500_index_fund">Drawdowns for Vanguard 500 Index Fund</label></h2>
                                <input type="checkbox" hidden id="toggle_drawdowns_vanguard_500_index_fund">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $drawdowns_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $drawdowns_vanguard_500_index_fund; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(nl2br($value)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>                            
                            <?php endif; ?>
                        </div>
                    </form>
                    <hr>
                    <h2><label for="toggle_timing_periods">Timing Periods</label></h2>
                    <input type="checkbox" hidden id="toggle_timing_periods">
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>                        
                        <div id="timing_periods">
                            <?php if(!count($timing_periods)): ?>
                            <input type="submit" value="Start Crawl Timing Periods" name="timing_periods">
                            <?php else: ?>
                            <input type="submit" value="Re-Crawl Timing Periods" name="timing_periods">
                            <div class="scrollable">
                                <table>
                                    <tr>
                                        <?php $__currentLoopData = $timing_periods_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e($key); ?></th>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php $__currentLoopData = $timing_periods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(nl2br($value)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>
                            </div>                            
                            <?php endif; ?>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </body>
</html>
