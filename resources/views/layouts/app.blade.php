<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accountant</title>
    <!-- Add mary-ui CSS or your custom stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">
    @yield('content')
</div>

<!-- Add mary-ui JavaScript or your custom scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
