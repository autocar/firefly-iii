<form style="display: inline;" id="income" action="{{route('budgets.postIncome')}}" method="POST">

{!! Form::token() !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Update (expected) income for {{Session::get('start', \Carbon\Carbon::now()->startOfMonth())->format('F Y')}}</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-addon">€</div>
                    <input step="any" class="form-control" id="amount" value="{{$amount->data}}" autocomplete="off" name="amount" type="number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</form>
