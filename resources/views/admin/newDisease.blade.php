<html>
<body>
<!-- Modal -->
<div class="modal fade" id="item" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Disease</h4>
            </div>

            <div class="modal-body">
                <form action="{{ URL::route('newDisease') }}" method="post" id="frmDisease">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
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