@php
    $model=$user = Auth::user();
@endphp
<div class="form-group {{  ($isError=$errors->has('password')) ? ' has-error' : '' }} ">
    @if($field->label)
        <label for="$field->name" class="col-md-4 col-xs-12 control-label">{{$field->label}}</label>
    @endif
    <div>
        <input
                @if($user)
                @if( !is_null( old($field->name) ) )
                value="{{old($field->name)}}"
                @endif
                {{--@elseif($field->isModelFieldExist())--}}
                {{--value="{{bcrypt($field->getValue($model->id))}}"--}}
                {{--@endif--}}
                @else
                @if( !is_null( old($field->name) ) )
                value="{{old($field->name)}}"
                @endif
                @endif
                @if($field->readonly) readonly="readonly" @endif id="password" type="password" name="password"
                placeholder="{{($field=$form->getField('password'))->placeholder}}" class="form-control">
        @if($isError)
            <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
        @endif
    </div>
</div>