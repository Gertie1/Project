<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pharma</title>

    <!-- Core CSS - Include with every page -->
{!! Html::style('../resources/assets/assets/plugins/bootstrap/bootstrap.css') !!}
{!! Html::style('../resources/assets/assets/font-awesome/css/font-awesome.css') !!}
{!! Html::style('../resources/assets/assets/plugins/pace/pace-theme-big-counter.css') !!}
{!! Html::style('../resources/assets/assets/css/style.css') !!}
{!! Html::style('../resources/assets/assets/css/main-style.css') !!}
{!! Html::style('../resources/assets/assets/plugins/social-buttons/social-buttons.css') !!}

 @yield('style')
    <style>
        body {
            font-family:'Lato';

        }


    </style>

</head>
<body>

@yield('content')

{!! Html::script('../resources/assets/assets/plugins/jquery-1.10.2.js') !!}
{!! Html::script('../resources/assets/assets/plugins/bootstrap/bootstrap.min.js') !!}
{!! Html::script('../resources/assets/assets/plugins/metisMenu/jquery.metisMenu.js') !!}
{!! Html::script('../resources/assets/assets/plugins/pace/pace.js') !!}
{!! Html::script('../resources/assets/assets/scripts/siminta.js') !!}

</body>
</html>
