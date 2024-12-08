<div 
  class="text-light" 
  style="
    background-image: url('images/img/login.png'); 
    background-size: cover; 
    background-position: center; 
    height: 60vh; 
    display: flex; 
    align-items: center; 
    justify-content: center;"
>
    <div class="card text-dark" style="max-width: 400px; width: 100%">
        <div class="card-body" style="padding: 1em">
            <h2 class="card-title text-center">Login to your account</h2>

            <!-- Display the error message if it exists -->
            @if(session('message'))
                <div class="alert alert-danger text-center">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Display the success message if it exists -->
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="post" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input 
                      type="text" 
                      class="form-control" 
                      id="username" 
                      name="username" 
                      placeholder="Enter your username" 
                      required 
                    />
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                      type="password" 
                      class="form-control" 
                      id="password" 
                      name="password" 
                      placeholder="Enter your password" 
                      required 
                    />
                </div>
                @error('username')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                Not registered? 
                <a href="{{ url('register') }}" class="text-primary">Create an account</a>
            </div>
        </div>
    </div>
</div>
