
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

			<textarea  rows="6"
			{{--@if($required) required text	@endif--}}
			class="form-control" type="text" name="{{$name.':'.$language->code}}"
		   @if($readonly) readonly @endif
				   aria-describedby="basic-addon1"
			>{{($model->{$name.':'.$language->code})?($model->{$name.':'.$language->code}): old($name.':'.$language->code)}}</textarea>
		</div>
		@if(count($errors->get($name.':'.$language->code))> 0)

			<ul class="form-element-errors">
				@foreach ($errors->get($name.':'.$language->code) as $error)
					<li>{!! $error !!}</li>
				@endforeach
			</ul>
		@endif
	@endforeach

	@include(AdminTemplate::getViewPath('form.element.partials.helptext'))
	@include(AdminTemplate::getViewPath('form.element.partials.errors'))
</div>
