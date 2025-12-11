<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BabyTracker</title>
</head>

<body class="min-h-screen flex">
{{-- Sidebar on the left --}}
@include('admin.layout.sidebar')

{{-- Main content area grows to fill the screen --}}
<main class="flex-1">
    @yield('content')
</main>

@include('admin.layout.footer')
</body>
</html>