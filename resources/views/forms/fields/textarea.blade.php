@php
    $model=$user = Auth::user();
@endphp
<textarea name="{{$field->name}}" id="{{$field->name}}" @if($field->required) required @endif
placeholder="{{$field->placeholder}}"
          @if($user)
              @if( !is_null( old($field->name) ) )
                {{old($field->name)}}
              @elseif($field->isModelFieldExist())
                {{$field->getValue($model->id)}}
              @endif

          @else
              @if( !is_null( old($field->name) ) )
              {{old($field->name)}}
              @endif
          @endif
          rows="4"
          class="form-control @if($errors->has($field->name)) has-error @endif "
>@if($user)@if( !is_null( old($field->name) ) ) {{old($field->name)}}@elseif($field->isModelFieldExist()){{$field->getValue($model->id)}}
        @endif
    @else
        @if( !is_null(old($field->name))) {{old($field->name)}}
        @endif
    @endif</textarea>
