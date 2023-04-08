@if ( ! empty($title))
	<div class="row">
		<div class="col-lg-12">
			{!! $title !!}
		</div>
	</div>
	<br />
@endif
@yield('before.panel')
{{--Request::fullUrl(), Request::path(), Request::is() and Request::segment().--}}
{{--{{ Request::path() }}--}}
@include('flash::message')
<div class="panel panel-default table-responsive">
	<div class="panel-heading">
		@if ($creatable)
			<a href="{{ url($createUrl) }}" class="btn btn-primary">
				<i class="fa fa-plus"></i> {{ $newEntryButtonText }}
			</a>
			{{--<a href="{{ url(Request::path().'/1/edit') }}" class="btn btn-primary">--}}
				{{--<i class="fa fa-edit"></i> Edit1--}}
			{{--</a>--}}
		@endif
		@yield('panel.buttons')

		<div class="pull-right">
			@yield('panel.heading.actions')
		</div>
	</div>
	@yield('panel.heading')
	@foreach($extensions as $ext)
		{!! $ext->render() !!}
	@endforeach
	@yield('panel.footer')
</div>

@yield('after.panel')
