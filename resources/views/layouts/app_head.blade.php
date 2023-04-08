<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="format-detection" content="telephone=no">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>{{($page)?$page->favicon_title:config('app.name', 'Laravel')}}</title>
<!-- Styles -->
{{--<link href="/css/app.css" rel="stylesheet">--}}

<!-- Bootstrap -->
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/owl.carousel.min.css" rel="stylesheet">
<link href="/css/owl.theme.default.css" rel="stylesheet">
<link href="/css/animate.css" rel="stylesheet">
<link href="/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/fullcalendar/fullcalendar.css"/>
<link  href="/css/cropper.css" rel="stylesheet">
<link href="/css/style.css" rel="stylesheet" >

<script src="/js/jquery-3.2.1.min.js"></script>
{{--<script src="/js/jquery-ui.min.js"></script>--}}
<script src="/js/fullcalendar/moment.min.js"></script>
<script src="/js/fullcalendar/fullcalendar.min.js"></script>
<script src='/js/fullcalendar/locale-all.js'></script>
{{--<script src='/js/fullcalendar/lang-all.js'></script>--}}

{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.print.css"/>--}}
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>

<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

{{--<script>--}}
    {{--window.Laravel = {!! json_encode([--}}
        {{--'csrfToken' => csrf_token(),--}}
    {{--]) !!};--}}
{{--</script>--}}