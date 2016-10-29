@extends('layouts.dashboard')
@section('content')
    @section('style')
        {!! Html::style('../resources/assets/assets/plugins/morris/morris-0.4.3.min.css') !!}
        @stop

    <!--  page-wrapper -->
    <div id="page-wrapper">

        <div class="row">
            <!-- Page Header -->
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!--End Page Header -->
        </div>

        <div class="row">
            <!-- Welcome -->
            <div class="col-lg-12">
                <div class="alert alert-info">
                    <i class="fa fa-folder-open"></i><b>&nbsp;Hello ! </b>Welcome Back <b> </b>

                </div>
            </div>
            <!--end  Welcome -->
        </div>


        <div class="row">
            <!--quick info section -->
            <div class="col-lg-6">
                <div class="alert alert-danger text-center">
                    <i class="fa fa-credit-card fa-3x"></i>&nbsp;<b>20 </b>Drugs rarely sold

                </div>
            </div>
            <div class="col-lg-6">
                <div class="alert alert-success text-center">
                    <i class="fa  fa-lightbulb-o fa-3x"></i>&nbsp;<b>27 % </b>Drugs sold often
                </div>
            </div>

            <!--end quick info section -->
        </div>

        <div class="row">
            <div class="col-lg-12">


            </div>



        </div>







    </div>
    <!-- end page-wrapper -->

</div>
<!-- end wrapper -->


<!-- Page-Level Plugin Scripts-->

@stop
@section('script')
{!! Html::script('../resources/assets/assets/plugins/morris/raphael-2.1.0.min.js') !!}
{!! Html::script('../resources/assets/assets/plugins/morris/morris.js') !!}
{!! Html::script('../resources/assets/assets/scripts/dashboard-demo.js') !!}
@stop