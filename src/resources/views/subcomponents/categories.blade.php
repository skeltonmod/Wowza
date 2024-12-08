<section class="popular">
    <div class="container">
        <div class="title text-xs-center m-b-30">
            <h2>All Categories</h2>
        </div>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                    <div class="food-item-wrap">
                        <img class="figure-wrap bg-image" style="width: 100%" src="{{ asset('images/' . $category->image) }}" />
                        <div class="content">
                            <center>
                                <h5><a href="{{ route('dish.category') }}?category_id={{$category->id}}">{{ $category->name }}</a></h5>
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
