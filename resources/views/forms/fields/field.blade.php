
<div id='{{$field->name}}' class="form-group @if($errors->has($field->name)) has-error @endif ">
    {{--{{$field->element}}--}}
    @if($field->label)
        <label for="{{$field->name}}" class="col-md-4 col-xs-12 control-label">{{$field->label}}</label>
    @endif
    <div>
    @switch($field->element)
        @case('textarea')
                @includeIfExist('forms.fields.textarea', ['field'=> $field])
        @break
        @case('text')
            @includeIfExist('forms.fields.text', ['field'=> $field])
        @break
    @endswitch
    @if($errors->has($field->name))
        <div class="text-danger">{{ $errors->first($field->name)}}</div>
    @endif
    </div>
</div>