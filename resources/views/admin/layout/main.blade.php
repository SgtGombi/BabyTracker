<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- csrf token fontos, nezz arra is ra! jo cucc -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BabyTracker</title>
</head>
<body>
    <!-- ilyen a layout: footer és sidebar fájlt egy harmadik fő layoutba teszem.
        A content rész majd a tartalom, így ha létrehozol admin-ba egy view-t, úgy kezded hogy
        extends admin.layout.main, és csak a body részt kell írnod. A többit beilleszti.
    -->
    @include('admin.layout.sidebar')
    <main>
        @yield('content')
    </main>
    @include('admin.layout.footer')
</body>
</html>