@extends('layouts.dashboard')
@section('content')


    <div id="page-wrapper">

        <div class="row">
            <!-- Page header-->
            <div class="col-lg-12">
                <h1 class="page-header">Charts</h1>
            </div>
            <!--End Page header-->
        </div>

        <div id="container"
             style="min-width: 310px; height: 600px; margin: 0 auto">

        </div>

        <form action="{{ URL::route('charts') }}" method="post" id="">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
            </div>
            <input type="submit" value="Save" id="save" class="btn btn-primary">


        </form>





       {{-- <?php echo json_encode($chartArray); ?>--}}

    </div>
  {{--  <script>
        $(function() {
            $('#container').highcharts(
                    <?php echo json_encode($chartArray); ?>
            )
        });

    </script>--}}



@stop