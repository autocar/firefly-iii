@extends('layouts.default')
@section('content')
{!! Breadcrumbs::renderIfExists(Route::getCurrentRoute()->getName(), $category) !!}
<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Overview
            </div>
            <div class="panel-body">
                <div id="componentOverview"></div>
            </div>
        </div>

         <div class="panel panel-default">
            <div class="panel-heading">
                Transactions
            </div>
            <div class="panel-body">
                @include('list.journals-full')
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-5">
        (TODO)
    </div>
</div>

@stop
@section('scripts')
<script type="text/javascript">
    var componentID = {{$category->id}};
    var year = {{Session::get('start',\Carbon\Carbon::now()->startOfMonth())->format('Y')}};
    var currencyCode = '{{Amount::getCurrencyCode()}}';
</script>
<!-- load the libraries and scripts necessary for Google Charts: -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="js/gcharts.options.js"></script>
<script type="text/javascript" src="js/gcharts.js"></script>
<script type="text/javascript" src="js/categories.js"></script>

@stop
