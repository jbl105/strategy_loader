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
                    <h1 class="title">Create new type</h1>
                    <div class="status"><strong><?php echo e(session('status')); ?></strong></div>
                    <form method="POST">
                        <?php echo e(csrf_field()); ?>

                        <div>
                            <input type="text" name="name" placeholder="Name" required>
                            <p>
                            <?php if($errors->has('name')): ?>
                                <?php echo e($errors->first('name')); ?>

                            <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <input type="text" name="slug" placeholder="Slug">
                            <p>
                            <?php if($errors->has('slug')): ?>
                                <?php echo e($errors->first('slug')); ?>

                            <?php endif; ?>
                            </p>
                        </div>
                        <div>
                            <input type="url" name="link" placeholder="Link">
                            <p>
                            <?php if($errors->has('link')): ?>
                                <?php echo e($errors->first('link')); ?>

                            <?php endif; ?>
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
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($type->name); ?></td>
                            <td><?php echo e($type->slug); ?></td>
                            <td><?php echo e($type->link); ?></td>
                            <td><a href="<?php echo e(url('/crawl/' . $type->slug)); ?>">Crawl data</a></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>                
            </div>
        </div>
    </body>
</html>
