<!DOCTYPE html>
<html lang="en">
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
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
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
                    <a href="<?php echo e(url('/login')); ?>">Login</a>
                    <a href="<?php echo e(url('/register')); ?>">Register</a>
                </div>
            <?php endif; ?>

            <div class="content">
                <div class="title m-b-md">
                    Envy Management
                </div>

                <div class="links">
                    <a href="<?php echo e(route('accounts.index')); ?>">Users</a>
                    <a href="<?php echo e(route('categories.index')); ?>">Categories</a>
                    <a href="<?php echo e(route('filters.index')); ?>">Filters</a>
                    <a href="<?php echo e(route('places.index')); ?>">Places</a>
                    <a href="<?php echo e(route('flags.index')); ?>">Flagged Content</a>
                </div>

                <table cellspacing="0" cellpadding="0" border="0" style="margin:20px auto">
                    <tr>
                        <td style="border:1px solid #000;border-right:0;border-bottom:0;padding:20px;border-top-left-radius:5px;">Users:</td>
                        <td style="border:1px solid #000;padding:20px;border-bottom:0;border-top-right-radius:5px;font-size:2rem;"><?php echo e($stats->users->total); ?></td>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000;border-right:0;border-bottom:0;padding:20px;border-top-left-radius:5px;">Stylists:</td>
                        <td style="border:1px solid #000;padding:20px;border-bottom:0;border-top-right-radius:5px;font-size:2rem;"><?php echo e($stats->stylists->total); ?></td>
                    </tr>

                    <tr>
                        <td style="border:1px solid #000;border-right:0;padding:20px;border-bottom-left-radius:5px;">Posts:</td>
                        <td style="border:1px solid #000;padding:20px;border-bottom-right-radius:5px;font-size:2rem;"><?php echo e($stats->posts->numPublished); ?></td>
                    </tr>
                    
                                         
                </table>

            </div>
        </div>
    </body>
</html>
