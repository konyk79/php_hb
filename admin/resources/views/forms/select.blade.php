<div class="form-group form-element-select {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}" class="control-label">
        {{ $label }}

        @if($required)
            <span class="form-element-required">*</span>
        @endif
    </label>
        @php
        //dump($value);
        //    dump($options);
            if(isset($options[0]) && isset($options[0]['id']) && isset($options[0]['text']) && ($options[0]['text'] === $options[0]['id'] )){
            if (is_numeric($value)){
                if (is_set($options[$value]))
                    $value =  $options[$value]['text'];
                }
            }
        @endphp
    <deselect :value="{{ (ctype_digit(strval($value)) ? $value : json_encode($value)) }}"
              :id="'{{str_replace(['[', ']'], '', $name)}}'"
              :multiple="false"
              :options="{{json_encode($options)}}" inline-template>
        <div>
            <multiselect @if($readonly)
                         :disabled="true"
                         @endif
                         v-model="val"
                         track-by="id"
                         label="text"
                         :multiple="multiple"
                         :searchable="true"
                         :options="options"
                         @if(count($options))
                         placeholder="{{ trans('sleeping_owl::lang.select.placeholder') }}"
                         @else
                         placeholder="{{ trans('sleeping_owl::lang.select.no_items') }}"
                         @endif
                         :select-label="'{{trans('sleeping_owl::lang.select.init')}}'"
                         :selected-label="'{{trans('sleeping_owl::lang.select.selected')}}'"
                         :deselect-label="'{{trans('sleeping_owl::lang.select.deselect')}}'"
            >
            </multiselect>

            <input type="hidden"  {!! $attributes !!}
                   id="{{ str_replace(['[', ']'], '', $name) }}"
                   name="{{$name}}"
                   v-model="preparedVal">
        </div>
    </deselect>

    @include(AdminTemplate::getViewPath('form.element.partials.helptext'))
    @include(AdminTemplate::getViewPath('form.element.partials.errors'))
</div>
