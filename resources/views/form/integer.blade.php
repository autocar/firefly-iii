<div class="{{{$classes}}}">
    <label for="{{{$options['id']}}}" class="col-sm-4 control-label">{{{$label}}}</label>
    <div class="col-sm-8">
        <div class="input-group">
            {!! Form::input('number', $name, $value, $options) !!}
            @include('form.feedback')
        </div>
    </div>
</div>