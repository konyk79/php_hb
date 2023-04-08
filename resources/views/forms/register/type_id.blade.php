@php
    $types = \App\Group::getRegistrationTypes();
    $typeIdVal = "";
    if(isOldValueExist('type_id')) {
    $typeIdVal = old('type_id');
    }
@endphp
<div class="   form-group {{  ($isError=$errors->has('type_id')) ? ' has-error' : '' }}">
    <div class="custom-select-box">

        <div class="triangle"></div>

        <select required name="type_id" id="type_id" class="form-control">
            <option  value="">{{($field=$form->getField('type_id'))->placeholder}}</option>
            @php
                foreach($types as $type){
                if($type->id != $typeIdVal) {
                echo '<option value="'. $type->id .'" >' . $type->name . '</option>';
                } else {
                echo '<option value="'. $type->id .'" selected>' . $type->name . '</option>';
                }
                }

            @endphp
        </select>
    </div>
    @if($isError)
        <div class="text-danger">{{  $isError=$errors->first($field->name)}}</div>
    @endif
</div>
<!--IF type choice сoorporate-->