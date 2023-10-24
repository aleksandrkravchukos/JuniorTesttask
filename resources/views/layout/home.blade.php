<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>

<div class="container">
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>


