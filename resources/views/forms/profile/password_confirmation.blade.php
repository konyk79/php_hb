<div class="   form-group {{  ($isError=$errors->has('password_confirmation')) ? ' has-error' : '' }} ">
    @if($field->label)
        <label for="$field->name" class="col-md-4 col-xs-12 control-label">{{$field->label}}</label>
    @endif
    <div>
    <input @if($field->readonly) readonly="readonly" @endif id="password-confirm" type="password" name="password_confirmation"
           placeholder="{{($field=$form->getField('password_confirmation'))->placeholder}}" class="form-control">
    @if($isError)
        <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
    @endif
    </div>
</div>