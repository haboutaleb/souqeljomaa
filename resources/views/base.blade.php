<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>النوتة</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Tajawal" rel="stylesheet">
<style>
body{
  font-family: 'Tajawal', sans-serif;

}
</style>
</head>
<body>
  <div class="container">
    @yield('main')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script src="{{ asset('jquery.min.js')}}"></script>
  @yield('script')
  
</body>
</html>