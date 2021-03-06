@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName(), $journal) !!}
{!! Form::open(['class' => 'form-horizontal','id' => 'destroy','url' => route('transactions.destroy',$journal->id)]) !!}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- panel for mandatory fields -->
        <div class="panel panel-danger">
            <div class="panel-heading">
                <i class="fa fa-exclamation-circle"></i> Destroy "{{{$journal->description}}}"
            </div>
            <div class="panel-body">
                <p>
                Deleting stuff from Firefly is <em>permanent</em>. This action will remove the transaction and all
                associated data.
                </p>
                <p class="text-success">
                    This action will not destroy categories, piggy banks, accounts, etc.
                </p>
                <p class="text-danger">
                    Are you sure?
                </p>
                <div class="btn-group">
                    <input type="submit" name="submit" value="Delete transaction" class="btn btn-danger" />
                    @if($journal->transactiontype->type == 'Withdrawal')
                        <a href="{{route('transactions.index','withdrawal')}}" class="btn-default btn">Cancel</a>
                    @endif
                    @if($journal->transactiontype->type == 'Deposit')
                        <a href="{{route('transactions.index','deposit')}}" class="btn-default btn">Cancel</a>
                    @endif
                    @if($journal->transactiontype->type == 'Transfer')
                        <a href="{{route('transactions.index','transfers')}}" class="btn-default btn">Cancel</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}

@stop
