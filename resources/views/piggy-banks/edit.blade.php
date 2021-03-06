@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName(), $piggyBank) !!}
{!! Form::model($piggyBank, ['class' => 'form-horizontal','id' => 'update','url' => route('piggy-banks.update',$piggyBank->id)]) !!}

<input type="hidden" name="repeats" value="0" />
<input type="hidden" name="id" value="{{$piggyBank->id}}" />

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-fw fa-exclamation"></i> Mandatory fields
            </div>
            <div class="panel-body">
                @foreach($errors->all() as $err)
                    {{$err}}
                @endforeach

                {!! ExpandedForm::text('name') !!}
                {!! ExpandedForm::select('account_id',$accounts,null,['label' => 'Save on account']) !!}
                {!! ExpandedForm::amount('targetamount') !!}

            </div>
        </div>
        <p>
            <button type="submit" class="btn btn-lg btn-success">
                <i class="fa fa-pencil"></i> Update piggy bank
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
                {!! ExpandedForm::date('targetdate') !!}
                {!! ExpandedForm::checkbox('remind_me','1',$preFilled['remind_me'],['label' => 'Remind me']) !!}
                {!! ExpandedForm::select('reminder',$periods,$preFilled['reminder'],['label' => 'Remind every']) !!}
            </div>
        </div>

        <!-- panel for options -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bolt"></i> Options
            </div>
            <div class="panel-body">
                {!! ExpandedForm::optionsList('update','piggy bank') !!}
            </div>
        </div>

    </div>
</div>

{!! Form::close() !!}
@stop
