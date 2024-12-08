<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">All Dishes</h4>
                </div>

                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Category</th>
                                <th>Dish</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stocks</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($dishes as $dish)
                                <tr>
                                    <td>{{ $dish->category->name }}</td>
                                    <td>{{ $dish->name }}</td>
                                    <td>{{ $dish->description }}</td>
                                    {{-- Format the price --}}
                                    <td>{{ number_format($dish->price, 2) }}</td>
                                    <td>{{ $dish->stock }}</td>
                                    {{-- Render an image from the public folder --}}
                                    <td>
                                        <img src="{{ asset('images/' . $dish->image) }}" alt="{{ $dish->name }}"
                                            class="img-thumbnail" style="width: 100px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.dish.edit', ['id' => $dish->id]) }}"
                                            class="btn btn-info btn-sm">Edit</a>
                                        {{-- Call the controller directly --}}
                                        <a href="{{ route('dish.delete', ['id' => $dish->id]) }}"
                                            class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Dishes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
