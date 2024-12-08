<div class="info">
    <h1>Admin Panel</h1>
</div>

<div class="form">
    <div class="thumbnail"><img src="{{ secure_asset('images/admin/manager.png') }}" /></div>

    @if ($errors->any())
        <span style="color:red;">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </span>
    @endif

    @if (session('success'))
        <span style="color:green;">{{ session('success') }}</span>
    @endif

    <form class="login-form" action="{{ route('login') }}" method="POST">
        @csrf
        <input type="text" placeholder="Username" name="username" />
        <input type="password" placeholder="Password" name="password" />
        <input type="submit" value="Login" />
    </form>
</div>
