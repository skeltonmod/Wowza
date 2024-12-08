
<div class="page-wrapper">
    <div class="container">
        <ul></ul>
    </div>

    <section class="contact-page inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="widget">
                        <div class="widget-body">
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username"  autofocus>
                                        @error('username')
                                            <span style="color:red;">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" type="text" name="first_name" id="first_name" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" type="text" name="last_name" id="last_name" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" name="email" id="email" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="phone">Phone number</label>
                                        <input class="form-control" type="text" name="phone" id="phone" >
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" >
                                        @error('password')
                                            <span style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="password_confirmation">Confirm password</label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                                        @error('password_confirmation')
                                            <span style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="address">Delivery Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" ></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="submit" value="Register" class="btn theme-btn">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>