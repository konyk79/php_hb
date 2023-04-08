<div class="   form-group {{  ($isError=$errors->has('password_confirmation')) ? ' has-error' : '' }}">
    <input id="password-confirm" type="password" name="password_confirmation"
           placeholder="{{($field=$form->getField('password_confirmation'))->placeholder}}" class="form-control">
    @if($isError)
        <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
    @endif
</div>