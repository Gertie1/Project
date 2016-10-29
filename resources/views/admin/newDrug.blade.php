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

                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="current_stock" name="current_stock" placeholder="Current Stock">
                    </div>
                   {{-- <div class="form-group">
                        <input type="number" class="form-control" id="total_stock" name="total_stock" placeholder="Total Stock">
                    </div>--}}
                    <div class="form-group">
                        <input type="number" class="form-control" id="used_stock" name="used_stock" placeholder="Used Stock">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" id="date_received" name="date_received" placeholder="Date Received">
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