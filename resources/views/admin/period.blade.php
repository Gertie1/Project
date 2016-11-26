<html>
<body>
<!-- Modal -->
<div class="modal fade" id="often_form" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Period</h4>
            </div>

            <div class="modal-body">
                <form action="{{ URL::route('often') }}" method="post" id="frmDrug">
                    {{ csrf_field() }}

                    <div class="form-group">
                        {{--<input type="text" class="form-control" id="month" name="month" placeholder="Enter Month">--}}
                        <select class="form-control " name="month" id="month" placeholder="Enter Month" >

                            <option name="month"> January</option>
                            <option name="month"> February</option>
                            <option name="month"> March</option>
                            <option name="month"> April</option>
                            <option name="month"> May</option>
                            <option name="month"> June</option>
                            <option name="month"> July</option>
                            <option name="month"> August</option>
                            <option name="month"> September</option>
                            <option name="month"> October</option>
                            <option name="month"> November</option>
                            <option name="month"> December</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="year" name="year" placeholder="Enter year">
                    </div>


                    <input type="hidden" name="id" id="id" value="">
                    <div class="modal-footer">
                        <input type="submit" value="Submit" id="save" class="btn btn-primary">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>