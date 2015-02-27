@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName())  !!}
{!! Form::open(['class' => 'form-horizontal','id' => 'store','url' => route('bills.store')]) !!}

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-6">
        <!-- panel for mandatory fields -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-exclamation-circle"></i> Mandatory fields
            </div>
            <div class="panel-body">
                {!! ExpandedForm::text('name') !!}
                {!! ExpandedForm::tags('match') !!}
                {!! ExpandedForm::amount('amount_min') !!}
                {!! ExpandedForm::amount('amount_max') !!}
                {!! ExpandedForm::date('date',Carbon\Carbon::now()->addDay()->format('Y-m-d')) !!}
                {!! ExpandedForm::select('repeat_freq',$periods,'monthly') !!}
            </div>
        </div>
        <p>
            <button type="submit" class="btn btn-lg btn-success">
                <i class="fa fa-plus-circle"></i> Store new bill
            </button>
        </p>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-6">
        <!-- panel for optional fields -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-smile-o"></i> Optional fields
            </div>
            <div class="panel-body">
                {!! ExpandedForm::integer('skip',0) !!}
                {!! ExpandedForm::checkbox('automatch',1,true) !!}
                {!! ExpandedForm::checkbox('active',1,true) !!}
            </div>
        </div>

        <!-- panel for options -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bolt"></i> Options
            </div>
            <div class="panel-body">
            {!! ExpandedForm::optionsList('create','bill') !!}
        </div>
    </div>

    </div>
</div>

{!! Form::close() !!}


@stop
@section('styles')
    <link href="css/bootstrap-tagsinput.css" type="text/css" rel="stylesheet" media="all">
@stop
@section('scripts')
    <script type="text/javascript" src="js/bootstrap-tagsinput.min.js"></script>
@stop
