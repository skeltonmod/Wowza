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
                                                src="{{ secure_asset('images/' . $item->image) }}" alt="Food logo"></a>
                                    </div>
                                    <div>
                                        <h6><a href="#">{{ $item['name'] }}</a></h6>
                                        <p>{{ $item['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
