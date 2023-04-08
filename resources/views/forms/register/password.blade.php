<div class="   form-group {{  ($isError=$errors->has('password')) ? ' has-error' : '' }}">
    <input id="password" type="password" name="password"
           placeholder="{{($field=$form->getField('password'))->placeholder}}" class="form-control">
    @if($isError)
        <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
    @endif
</div>