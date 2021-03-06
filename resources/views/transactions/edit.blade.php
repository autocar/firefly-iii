@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName(), $journal) !!}
{!! Form::open(['class' => 'form-horizontal','id' => 'update','url' => route('transactions.update',$journal->id)]) !!}

<input type="hidden" name="id" value="{{$journal->id}}" />
<input type="hidden" name="what" value="{{$what}}" />

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
    <!-- panel for mandatory fields -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <i class="fa fa-exclamation-circle"></i> Mandatory fields
                </div>
                <div class="panel-body">
                    <!-- ALWAYS AVAILABLE -->
                    {!! ExpandedForm::text('description',$journal->description) !!}

                    <!-- SHOW ACCOUNT (FROM) ONLY FOR WITHDRAWALS AND DEPOSITS -->
                    @if($what == 'deposit' || $what == 'withdrawal')
                        {!! ExpandedForm::select('account_id',$accounts,$data['account_id']) !!}
                    @endif

                    <!-- SHOW EXPENSE ACCOUNT ONLY FOR WITHDRAWALS -->
                    @if($what == 'withdrawal')
                        {!! ExpandedForm::text('expense_account',$data['expense_account']) !!}
                    @endif
                    <!-- SHOW REVENUE ACCOUNT ONLY FOR DEPOSITS -->
                    @if($what == 'deposit')
                        {!! ExpandedForm::text('revenue_account',$data['revenue_account']) !!}
                    @endif

                    <!-- ONLY SHOW FROM/TO ACCOUNT WHEN CREATING TRANSFER -->
                    @if($what == 'transfer')
                        {!! ExpandedForm::select('account_from_id',$accounts,$data['account_from_id']) !!}
                        {!! ExpandedForm::select('account_to_id',$accounts,$data['account_to_id']) !!}
                    @endif

                    <!-- ALWAYS SHOW AMOUNT -->
                    {!! ExpandedForm::amount('amount',$data['amount'],['currency' => $journal->transactionCurrency]) !!}

                    <!-- ALWAYS SHOW DATE -->
                    {!! ExpandedForm::date('date',$data['date']) !!}
            </div>
        </div> <!-- close panel -->

        <p>
            <button type="submit" class="btn btn-lg btn-success">
                <i class="fa fa-plus-circle"></i> Update {{{$what}}}
            </button>
        </p>

    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <!-- panel for optional fields -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-smile-o"></i> Optional fields
            </div>
            <div class="panel-body">
                <!-- BUDGET ONLY WHEN CREATING A WITHDRAWAL -->
                @if($what == 'withdrawal')
                    {!! ExpandedForm::select('budget_id',$budgets,$data['budget_id']) !!}
                @endif
                <!-- CATEGORY ALWAYS -->
                {!! ExpandedForm::text('category',$data['category']) !!}

                <!-- TAGS -->

                <!-- RELATE THIS TRANSFER TO A PIGGY BANK -->
                @if($what == 'transfer' && count($piggies) > 0)
                    {!! ExpandedForm::select('piggy_bank_id',$piggies,$data['piggy_bank_id']) !!}
                @endif
                    </div>
            </div><!-- end of panel for options-->

            <!-- panel for options -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bolt"></i> Options
                </div>
                <div class="panel-body">
                    {!! ExpandedForm::optionsList('update','transaction') !!}
                </div>
            </div>
            </div>
        </div>
{!! Form::close() !!}


@stop
@section('scripts')
<script type="text/javascript" src="js/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript" src="js/transactions.js"></script>
@stop
