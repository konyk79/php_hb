@php
   $model=$user = Auth::user();
@endphp

<input type="text" @if($field->required) required @endif
@if($field->readonly)disabled @endif
name="{{$field->name}}"
       id="{{$field->name}}"
       placeholder="{{$field->placeholder}}"
       @if($user)
              @if( !is_null( old($field->name) ) )
                     value = "{{old($field->name)}}"
              @elseif($field->isModelFieldExist())
                     value="{{$field->getValue($model->id)}}"
              @endif

       @else
              @if( !is_null( old($field->name) ) )
                     value = "{{old($field->name)}}"
              @endif
       @endif
       class="form-control"
>