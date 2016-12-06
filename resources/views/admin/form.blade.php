@extends('layouts.dashboard')
@section('content')

    <html>
    <head>

        <meta name="_token" content="{!! csrf_token() !!}"/>

        <script src="../resources/assets/assets/plugins/bootstrap/http_maxcdn.bootstrapcdn.com_bootstrap_3.3.6_js_bootstrap.min.js"></script>
        <script src="../resources/assets/assets/plugins/jquery/http_ajax.googleapis.com_ajax_libs_jquery_1.12.0_jquery.min.js"></script>

    </head>
    <body>
    <div id="page-wrapper">

        <div class="row">
            <!-- Page header-->
            <div class="col-lg-12">
                <h1 class="page-header">Mapping</h1>
            </div>
            <!--End Page header-->
        </div>

        <div class="container">

            <div class="row">

                <div class="panel-body">
                    {{--<form role="form" method="post" action="{{ URL::route('mapping') }}" id="frmMapping">--}}
                    {!! Form::model($item,
                     [
                     'method' => 'PATCH',
                     'route' => ['updateMapping', $item->id]


]) !!}


                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                    <div class="form-group">
                        <label>Disease</label>
                        <select class="form-inline input-sm " name="disease" id="disease">
                            <option value="{{$disease->id}}"> {{$disease->name}}</option>
                            {{-- @foreach($diseases as $key => $disease)
                                 <option value="{{$disease->id}}"> {{$disease->name}}</option>
                             @endforeach--}}
                        </select>
                    </div>
                        </div>
                    <div class="row">
                    <div class="form-group">
                        <label>Drugs</label><br>
                        @foreach($drugs as $key=>$drug)
                            <div class="col-xs-4">
                            <input type="hidden" name="drug[]" value="0" />
                            <input class="checkbox-inline" type="checkbox" name="drug[]" value="{{ $drug->id }}" id="{{ $drug->id }}"
                                   @foreach($checked_drugs as $key=>$checked_drug)
                                   @if ($checked_drug == $drug->id)
                                   checked
                                    @endif
                                    @endforeach
                            >{{ $drug->name }} <br>
                                </div>
                        @endforeach

                    </div>
                        </div>
                    <br> <br>
                    <div class="row">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>

    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="_token"]').attr('content')
            }
        })

    </script>

    </body>
    </html>

@stop


