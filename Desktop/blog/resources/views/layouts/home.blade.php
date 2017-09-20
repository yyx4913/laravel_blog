<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('meta')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
    <![endif]-->
    <style>
        .page ul li span, .page ul li a {
            margin: 0 5px;
        }
    </style>
</head>
<body>
@yield('content')

<footer>
    <p>{!! Config::get('web.web_copyRight') !!}　<a href="/">{{Config::get('web.web_count')}}</a></p>
</footer>
<script src="{{asset('resources/views/home/js/silder.js')}}"></script>
</body>
</html>