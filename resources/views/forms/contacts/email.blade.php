<div class="form-group @if($errors->has($field->name)) has-error @endif ">
       {{--{{$field->element}}--}}
       <input type="text" @if($field->required) required @endif name="{{$field->name}}"
              id="{{$field->name}}"
              placeholder="{{$field->placeholder}}"
              @if($user)
              value="{{$user->email}}" readonly="readonly"
              {{--@if( !is_null( old($field->name) ) )--}}
              {{--value="{{old($field->name)}}"--}}
              {{--@endif--}}
              @else
              @if( !is_null( old($field->name) ) )
              value="{{old($field->name)}}"
              @endif
              @endif
              class="form-control"
       >
       @if($errors->has($field->name))
              <div class="text-danger">{{ $errors->first($field->name)}}</div>
       @endif
</div>

