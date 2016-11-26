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

        <form action="{{ URL::route('blank2') }}" method="post" id="">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
            </div>

                <button type="submit" class="btn btn-primary">Submit</button>
        </form>





    </div>



@stop