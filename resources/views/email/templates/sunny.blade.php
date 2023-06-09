<html>
	<head>
		<title>{{ $senderName or '' }}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">{{ file_get_contents(app_path() . '/../resources/views/email/styles/css/sunny.css') }}</style>
		@if(isset($css))
		<style type="text/css">
			{{ $css }}
		</style>
		@endif
	</head>
	<body>
	<table id="background-table" border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
			<td align="center">
				<table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
					<tbody>
					<tr class="large_only">
						<td class="w640" height="20" width="640"></td>
					</tr>
					<tr class="mobile_only">
						<td class="w640" height="10" width="640"></td>
					</tr>
					<tr class="mobile_only">
						<td class="w640" height="10" width="640"></td>
					</tr>
                    <tr class="mobile_only">
                        <td class="w640" align="center" width="640">
                            <table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
                                <tr>
                                    <td class="w30" width="30"></td>
                                    <td valign="top" align="center">
                                        {{--<img class="mobile_only mobile-logo" border="0" src="{{ $logo['path'] }}" alt="{{ $senderName or '' }}" width="{{ $logo['width'] or '' }}" height="{{ $logo['height'] or '' }}" />--}}
{{--										{{ config('app.name') }}--}}
                                    </td>
                                    <td class="w30" width="30"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
					<tr class="large_only">
						<td class="w640"  height="20" width="640"></td>
					</tr>
					<tr>
						<td class="w640" width="640" colspan="3" height="20"></td>
					</tr>
					<tr>
						<td id="header" class="w640" align="center" width="640">
							<table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
								<tr>
									<td class="w30" width="30"></td>
									<td id="logo" width="{{ $logo['width'] }}" valign="top">
										{{--<img border="0" src="{{ $logo['path'] }}" alt="{{ $senderName or ''}}" width="{{ $logo['width'] }}" height="{{ $logo['height'] }}" />--}}
										<a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a>
									</td>
									<td class="w30" width="30"></td>
								</tr>
								<tr>
									<td colspan="3" height="20" class="large_only"></td>
								</tr>
								<tr>
									<td colspan="3" height="20" class="large_only"></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td class="w640" bgcolor="#ffffff" width="640">
							<table class="w640" border="0" cellpadding="0" cellspacing="0" width="640">
								<tbody>

									@section('content')
									@show

									<!-- Salutation -->

									@include('email.templates.sunny.contentStart')
									<p>
										С уважением,<br>команда Harmonious Breathe<br>
									<div><img src="{{url('/img/logo.png')}}"></div>
									</p>
									<div style="float: left; width: 70%; margin-right: 5px;margin-left: 5px">
										<p>
											<b>Наш адрес:</b><br>
											Adress
										</p>
										<p>
											<b>Наша почта:</b><br>
											{{ Html::mailto('office@harmoniousbreathing.com') }}<br>
											{{ Html::mailto('support@harmoniousbreathing.com') }}<br>
										</p>
										<p>
											<b>Наш сайт:</b><br>
											<a href="{{ url('/') }}" target="_blank">{{ url('/') }}</a>
										</p>
									</div>
									<div>
										<p>
											<b>Наши телефоны:</b><br>
											+0041798523088
										</p>
									</div>
									@include('email.templates.sunny.contentEnd')

								</tbody>
							</table>
						</td>
					</tr>
					<tr>
						<td class="w640" bgcolor="#ffffff" width="640" colspan="3" height="20"></td>
					</tr>
					<tr>
						<td class="w640" bgcolor="#ffffff" width="640" colspan="3" height="20"></td>
					</tr>
					<tr>
						<td>
							<table width="640" class="w640" align="center" cellpadding="0" cellspacing="0">
								<tr>
									<td class="w50" width="50"></td>
									<td class="w410" width="410">
										@if (isset($reminder))
											<p id="permission-reminder" class="footer-content-left" align="left">{!! $reminder !!}</p>
										@endif
									</td>
									<td valign="top">
										<table align="right">
											<tr>
												<td colspan="2" height="10"></td>
											</tr>
											<tr>
												@if (isset($twitter))
													<td><a href="https://twitter.com/{{ $twitter }}"><img src="{{ Request::getSchemeAndHttpHost() }}/vendor/beautymail/assets/images/ark/twitter.png" alt="Twitter" height="25" width="25" style="border:0" /></a></td>
												@endif

												@if (isset($facebook))
													<td><a href="https://facebook.com/{{ $facebook }}"><img src="{{ Request::getSchemeAndHttpHost() }}/vendor/beautymail/assets/images/ark/fb.png" alt="Facebook" height="25" width="25" style="border:0" /></a></td>
												@endif
											</tr>
										</table>
									</td>
									<td class="w15" width="15"></td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td class="w640" width="640" colspan="3" height="20"></td>
					</tr>
					<tr>
						<td id="footer" class="w640" height="60" width="640" align="center">

							@section('footer')
							@show

							Copyright &copy; {{ date('Y') }}
							<a href="{{ url('/') }}" target="_blank">Harmonious Breathe</a>.
							All rights reserved.
						</td>
					</tr>
					<tr>
						<td class="w640" width="640" colspan="3" height="40"></td>
					</tr>
					</tbody>
				</table>
			</td>
		</tr>
		</tbody>
	</table>
	</body>
</html>
