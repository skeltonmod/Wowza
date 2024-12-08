<div class="m-t-10">
    <div class="container">
        <h4>{{ $category_name }}</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="collapse in">
                    <div class="row">
                        @foreach ($dishes as $item)
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="food-item">
                                    <div class="rest-logo">
                                        <a href="#"><img style="height: 240px; width: 100%;"
                                                src="{{ asset('images/' . $item->image) }}" alt="Food logo"></a>
                                    </div>
                                    <div>
                                        <h6><a href="#">{{ $item['name'] }}</a></h6>
                                        <p>{{ $item['description'] }}</p>
                                        @auth
                                        <p>Stocks: <strong>{{ $item['stock'] }}</strong></p>
                                        @endauth
                                    </div>
                                    @auth
                                        @if (auth()->user()->hasRole('user') || auth()->user()->hasRole('cashier'))
                                            <form method="POST" action="{{ route('cart.add', ['d_id' => $item->id]) }}">
                                                @csrf
                                                <input type="number" name="quantity" value="1" class="form-control"
                                                    size="2">
                                                <button type="submit" class="btn btn-primary">Add To Cart</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
