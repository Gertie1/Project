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
                <h1 class="page-header">Users</h1>
            </div>
            <!--End Page header-->
         </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-body">
            <div class="col-lg-8">
            </div>

            <div class="col-md-10">
                <button class="btn btn-primary" type="button" id="add" value="add" >ADD USER</button>
            </div>
                    </div>
                </div>
        </div>


        <div class="row">
            <div class="col-lg-10">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @include('admin.newUser')
                            <table class="table table-striped table-bordered table-hover" id="table">
                                <thead>
                                   <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center">Username</th>
                                      <th class="text-center">Email</th>
                                      <th class="text-center">Actions</th>
                                   </tr>
                                </thead>
                @foreach($users as $key => $item)
                    <tr id="item{{$item->id}}">
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            <div class="col-lg-3">
                            <button class="edit-modal btn btn-info btn-edit" data-id="{{$item->id}}"
                                    data-name="{{$item->name}}">Edit</button>
                            </div>
                            <button class="delete-modal btn btn-danger btn-delete" data-id="{{$item->id}}"
                                    data-name="{{$item->name}}" data-email="{{$item->email}}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </table>
                            </div>
                        </div>
                    </div>
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

        $("#add").on('click', function () {
            $("#item").modal('show');
        });

        

        $('#frmUser').on('submit',function(e){
            e.preventDefault();
            var form=$('#frmUser');
            var formData=form.serialize();
            var url=form.attr('action');
            $.ajax({
                type:'post',
                url:url,
                data:formData,
                success:function(data){
                    console.log(data);
                    addRow(data);
                    $('#frmUser').trigger('reset');
                    $('#name').focus();
                }

            });
        })

        function addRow(data) {
            var row='<tr>'+
                    '<td>'+ data.id +'</td>' +
                    '<td>'+ data.name +'</td>' +
                    '<td>'+ data.email +'</td>' +
                    '<td><button class="edit-modal btn btn-info">Edit</button>'+
                    '<button class="delete-modal btn btn-danger">Delete</button></td>' +
                    '</tr>';
            $('tbody').append(row);
        }

        $('tbody').delegate('.btn-edit','click',function () {
            var value=$(this).data('id');
            var url='{{URL::to('getUpdate')}}';
            $.ajax({
                type:'get',
                url:'url',
                data:{'id':value},
                success:function(data){
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#user').modal('show');

                }
            });

                });


</script>
</body>
</html>

@stop