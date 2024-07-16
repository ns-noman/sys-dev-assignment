<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ZOZ FLATS</title>
    @include('layouts.links')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        
        {{-- <div class="col-md-12 text-center"> --}}
            {{-- @include('layouts.flash-message') --}}
        {{-- </div> --}}
        {{-- <div class="content-wrapper"> --}}
            @yield('content')
        {{-- </div> --}}
        @include('layouts.footer')
    </div>
    @include('layouts.scripts')
</body>
@yield('script')
</html>
