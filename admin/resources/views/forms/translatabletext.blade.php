
@php
	//dd(get_defined_vars());
   /*     $value = $model->{$name};
        $required = $required;
        $readonly=false;
        $attributes_str='';
//        dd($attributes_str);
    //		dd($model);
            if (is_array($attributes)){
                foreach($attributes as $key => $value){
                    $attributes_str .= $key .'="'.$value.'" ';
                };
            }*/
            //dd($attributes_str);
        /*foreach($attributes as $key => $value){

        dump($key );
        dd($value);
        $attributes_str .= $key .'="'.$value.'" ';
        };
        $attributes_str = $attributes_str.'name='.$name.';*/
    //$attributes = 'type="text" name='.$name.' class="form-control"';
  //  $attributes_str = $attributes_str;

 //   dd($attributes_str);
@endphp
{{--{{ dd(get_defined_vars()) }}--}}
{{--@if (count($errors) > 0)--}}
	{{--<div class="error">--}}
		{{--<ul>--}}
			{{--@foreach ($errors->all() as $error)--}}
				{{--<li>{{ $error }}</li>--}}
			{{--@endforeach--}}
		{{--</ul>--}}
	{{--</div>--}}
{{--@endif--}}
<div class="table-bordered  form-group form-element-text ">
	<label  class="control-label  ">
		{{ $label }}

		@if($required)
			<span class="form-element-required">*</span>
		@endif
	</label>
	<br>
	@foreach (App\Language::all() as $language)
		<div class="input-group {{ (($errors->has($name.':'.$language->code))) ? 'has-error' : '' }}" >
				<span  class="input-group-addon" id="basic-addon1">{{$language->code}}</span>

			<input
			{{--@if($required) required text	@endif--}}
			class="form-control" type="text" name="{{$name.':'.$language->code}}"
			value="{{($model->{$name.':'.$language->code})?($model->{$name.':'.$language->code}): old($name.':'.$language->code)  }}"
		   @if($readonly) readonly @endif
				   aria-describedby="basic-addon1"
			>
		</div>
		@if(count($errors->get($name.':'.$language->code))> 0)

			<ul class="form-element-errors">
				@foreach ($errors->get($name.':'.$language->code) as $error)
					<li>{!! $error !!}</li>
				@endforeach
			</ul>
		@endif
	@endforeach

	{{--@include(AdminTemplate::getViewPath('form.element.partials.helptext'))--}}
	{{--@include(AdminTemplate::getViewPath('form.element.partials.errors'))--}}
</div>
