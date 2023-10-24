<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>@yield('title')</title>
    @stack('custom-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="navigation">
    <div class="content">
        <div class="navigation">
            <div class="vertical-menu" id="vmenu">
                <a href="/">Landing</a>
                <a href="{{route('users.index')}}">Users</a>
            </div>
            <div class="content">
                @yield('user-content')
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/app.js')}}" async></script>

</body>
</html>


