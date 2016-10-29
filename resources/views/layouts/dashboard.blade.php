<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Pharma</title>
    <!-- Core CSS - Include with every page -->
    {!! Html::style('../resources/assets/assets/plugins/bootstrap/bootstrap.css') !!}
    {!! Html::style('../resources/assets/assets/font-awesome/css/font-awesome.css') !!}
    {!! Html::style('../resources/assets/assets/plugins/pace/pace-theme-big-counter.css') !!}
    {!! Html::style('../resources/assets/assets/css/style.css') !!}
    {!! Html::style('../resources/assets/assets/css/main-style.css') !!}
    {!! Html::style('../resources/assets/assets/css/main-style.css') !!}
    {!! Html::style('../resources/assets/assets/highcharts/css/highcharts.css') !!}

    {!! Html::script('../resources/assets/assets/plugins/jquery-1.10.2.js') !!}
    {!! Html::script('../resources/assets/assets/plugins/bootstrap/bootstrap.min.js') !!}
    {!! Html::script('../resources/assets/assets/plugins/metisMenu/jquery.metisMenu.js') !!}
    {!! Html::script('../resources/assets/assets/plugins/pace/pace.js') !!}
    {!! Html::script('../resources/assets/assets/scripts/siminta.js') !!}
    <script src="../resources/assets/assets/highcharts/js/highcharts.js"></script>
    <script src="../resources/assets/assets/highcharts/js/modules/exporting.js"></script>

    @yield('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

   @yield('style')
</head>
<!-- Core Scripts - Include with every page -->
<body>
@if (Auth::check())

<!--  wrapper -->
<div id="wrapper">
<!-- navbar top -->
<!-- end navbar top -->
@include('include.header')
<!-- navbar side -->
@include('include.sidebar')
<!-- end navbar side -->
<!--  page-wrapper -->

@yield('content')
</div>
@else
    @yield('content')
@endif
<!-- end wrapper -->



</body>
</html>