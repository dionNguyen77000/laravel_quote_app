<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>

  @yield('styles')
</head>
<body>
  @include('includes.header')
  <div class="main">
      @yield('content')
  </div>
</body>
</html>
