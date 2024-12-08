<div class="container m-t-10">
    <div class="row">
        <!-- Cart Widget -->
        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
            <div class="widget widget-cart">
                <div class="widget-heading">
                    <h3 class="text-dark">Your Cart</h3>
                    @if (session('error') || request('success') == 'false')
                        <div class="alert alert-danger">
                            {{ session('error') ?? request('message') }}
                        </div>
                    @endif

                    @if (session('success') || request('success') == 'true')
                        <div class="alert alert-success">
                            {{ session('success') ?? request('message') }}
                        </div>
                    @endif
                </div>
                <div class="widget-body">
                    @php $item_total = 0; @endphp
                    @foreach (session('cart', []) as $item)
                        <div class="title-row">
                            {{ $item['name'] }}
                            <a href="{{ route('cart.remove', ['res_id' => request('res_id'), 'd_id' => $item['d_id']]) }}">
                                <i class="fa fa-trash pull-right"></i>
                            </a>
                        </div>
                        <div class="form-group row no-gutter">
                            <div class="col-xs-8">
                                <strong>₱{{ $item['price'] * $item['quantity'] }}</strong>
                            </div>
                            <div class="col-xs-4">
                                <strong>x{{ $item['quantity'] }}</strong>
                            </div>
                        </div>

                        @php $item_total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                    <div class="price-wrap text-xs-center">
                        <p>TOTAL</p>
                        <h3 class="value"><strong>₱{{ number_format($item_total, 2) }}</strong></h3>
                        <p>Free Delivery!</p>
                        {{-- Create a checkout button --}}
                        <a href="{{ route('cart.checkout') }}" class="btn theme-btn-dash">Pay via cash</a>
                        {{-- Create a pay with e-wallet button --}}
                        <a href="{{ route('ewallet.pay') }}" class="btn theme-btn-dash">Pay with E-Wallet</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Widget -->
        <div class="col-md-8">
            <div class="menu-widget" id="menu-section">
                <div class="widget-heading">
                    <h3 class="text-dark">MENU</h3>
                </div>
                <div class="collapse in">
                    <form method="GET" action="{{ route('menu') }}">
                        <div class="form-group">
                            <label for="category">Select Category:</label>
                            <select name="category_id" id="category" class="form-control" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    @foreach ($dishes as $item)
                        <div class="food-item">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-lg-8">
                                    <div class="rest-logo pull-left">
                                        <a href="#"><img style="height: 100px; width: 100px;"
                                                src="{{ asset('images/' . $item->image) }}" alt="Food logo"></a>
                                    </div>
                                    <div class="rest-descr">
                                        <h6><a href="#">{{ $item['name'] }}</a></h6>
                                        <p>{{ $item['description'] }}</p>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                    <span class="price pull-left">₱{{ number_format($item['price'], 2) }}</span>
                                    <form method="POST" action="{{ route('cart.add', ['d_id' => $item['id']]) }}">
                                        @csrf
                                        <input type="number" name="quantity" value="1" class="form-control" size="2">
                                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>