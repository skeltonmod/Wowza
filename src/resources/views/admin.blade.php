<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="{{ secure_asset('css/admin/login.css') }}">
    <link href="{{ secure_asset('css/admin/lib/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/admin/helper.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/admin/style.css') }}" rel="stylesheet">
</head>

<body class="fix-header">
    @auth
        @if (auth()->user()->hasRole('admin'))
            @include('subcomponents.topbar')
            @include('subcomponents.sidebar')
        @endif
    @endauth
    <div class="container scrollable-container">
        {{-- HAHAHA may nalang ni kaysa sigeg himo og php files, for AMA by AMA --}}
        @if (Route::is('admin.login'))
            @include('admin.login')
        @elseif (Route::is('admin.dashboard'))
            @include('admin.dashboard')
        @elseif (Route::is('admin.user.all'))
            @include('admin.user.all')
        @elseif (Route::is('admin.user.customer.all'))
            @include('admin.user.all')
        @elseif (Route::is('admin.user.add'))
            @include('admin.user.add')
        @elseif (Route::is('admin.user.edit'))
            @include('admin.user.edit')
        @elseif (Route::is('admin.dish.all'))
            @include('admin.dish.all')
        @elseif (Route::is('admin.dish.create'))
            @include('admin.dish.add')
        @elseif (Route::is('admin.dish.edit'))
            @include('admin.dish.edit')
        @elseif (Route::is('admin.dish.category.create'))
            @include('admin.dish.category.add')
        @elseif (Route::is('admin.orders'))
            @include('admin.orders.all')
        @elseif (Route::is('admin.orders.restaurant'))
            @include('admin.orders.restaurant.all')
        @endif
    </div>



    <script src="{{ secure_asset('js/admin/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ secure_asset('js/admin/lib/bootstrap/js/admin/popper.min.js') }}"></script>
    <script src="{{ secure_asset('js/admin/lib/bootstrap/js/admin/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('js/admin/jquery.slimscroll.js') }}"></script>
    <script src="{{ secure_asset('js/admin/sidebarmenu.js') }}"></script>
    <script src="{{ secure_asset('js/admin/lib/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ secure_asset('js/admin/custom.min.js') }}"></script>

    <script src="{{ secure_asset('js/admin/index.js') }}"></script>

</body>

</html>
