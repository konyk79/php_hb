<div class="   form-group {{  ($isError=$errors->has('country')) ? ' has-error' : '' }} ">
    @if($field->label)
        <label for="$field->name" class="col-md-4 col-xs-12 control-label">{{$field->label}}</label>
    @endif
    <div>
    <div class="custom-select-box">
        <div class="triangle"></div>
        @php
            $countryIdVal = "";
            if(isOldValueExist('country_id')) {
            $countryIdVal = old('country_id');
            } else {
            if($user) {
            $countryIdVal = $user->country_id;
            }
            }
        @endphp
        <select
                @if($field->readonly) readonly="readonly" @endif
                required name="country_id" id="country-choice" class=" selectpicker form-control">
            <option value="">{{($field=$form->getField('country_id'))->placeholder}}</option>
            @php
                foreach(\App\Country::all() as $country){
                if($country->id != $countryIdVal) {
                echo '<option value="' . $country->id . '" >' . $country->name . '</option>';
                } else {
                echo '<option value="' . $country->id . '" selected>' . $country->name . '</option>';
                }
                }
            @endphp
        </select>
    </div>
    @if($isError)
        <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
    @endif
    </div>
</div>