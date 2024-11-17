<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="{{ mix('build/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center">
    @yield('content')
</div>
</body>
</html>
