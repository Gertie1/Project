<html>
<body>
<!-- Modal -->
<div class="modal fade" id="item" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Drug</h4>
            </div>

            <div class="modal-body">
                <form action="{{ URL::route('newDrug') }}" method="post" id="frmDrug">
                    {{ csrf_field() }}

                    {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>--}}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="error">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>


                         <input type="hidden" name="id" id="id" value="">
            <div class="modal-footer">
                <input type="submit" value="Save" id="save" class="btn btn-primary">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>


                 </form>


            </div>
        </div>
     </div>
</div>
</body>
</html>