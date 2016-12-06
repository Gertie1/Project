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






        {{-- <?php echo json_encode($chartArray); ?>--}}

    </div>
     {{-- <script>
          $(function() {
              $('#container').highcharts(
                      <?php echo json_encode($chartArray); ?>
              )
          });

      </script>--}}



@stop