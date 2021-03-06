@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName()) !!}
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa {{$mainTitleIcon}}"></i> {{{$title}}}

            <!-- ACTIONS MENU -->
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                        Actions
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li><a href="{{route('bills.create')}}"><i class="fa fa-plus fa-fw"></i> New bill</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="panel-body">
            @include('list.bills')
        </div>
        </div>
    </div>
</div>
@stop
@section('scripts')

@stop
