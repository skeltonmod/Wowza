<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="col-sm">
                <div class="bg-gray p-3" style="border-radius: 8px;">
                    <table class="table table-bordered table-hover">
                        <thead style="background: #404040; color:white;">
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($orders->isEmpty())
                                <tr>
                                    <td colspan="6">
                                        <center>You have no orders placed yet.</center>
                                    </td>
                                </tr>
                            @else
                                @foreach ($orders as $order)
                                    <tr>
                                        <td data-column="Item">
                                            @if ($order->dishes->isEmpty())
                                                <div>No dishes found for this order.</div>
                                            @else
                                                @foreach ($order->dishes as $dish)
                                                    <div>
                                                        <strong>{{ $dish->name }}</strong> - Quantity:
                                                        {{ $dish->pivot->quantity }}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td data-column="Price">₱{{ number_format($order->total, 2) }}</td>
                                        <td data-column="Status">
                                            @php $status = $order->status; @endphp
                                            @if (!$status)
                                                <button type="button" class="btn btn-info">
                                                    <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                </button>
                                            @elseif($status == 'pending')
                                                <button type="button" class="btn btn-warning">
                                                    <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                                    Preparing!
                                                </button>
                                            @elseif($status == 'processing')
                                                <button type="button" class="btn btn-warning">
                                                    <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                                    On The Way!
                                                </button>
                                            @elseif($status == 'delivered')
                                                <button type="button" class="btn btn-success">
                                                    <span class="fa fa-check-circle" aria-hidden="true"></span>
                                                    Delivered
                                                </button>
                                            @elseif($status == 'rejected')
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fa fa-close"></i> Cancelled
                                                </button>
                                            @endif
                                        </td>
                                        <td data-column="Date">{{ $order->created_at }}</td>
                                        <td data-column="Action">
                                            <a href="{{ url('delete_orders', $order->id) }}"
                                                onclick="return confirm('Are you sure you want to cancel your order?');"
                                                class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                <i class="fa fa-trash-o" style="font-size:16px"></i>
                                            </a>

                                            <a href="{{ route('orders.change', ['order_id' => $order->id, 'status' => 'rejected']) }}"
                                                class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                <i class="fa fa-close" style="font-size:16px"></i> Cancel
                                            </a>
                                            
                                            <a href="{{ route('orders.change', ['order_id' => $order->id, 'status' => 'processing']) }}"
                                                class="btn btn-warning btn-flat btn-addon btn-xs m-b-10">
                                                <i class="fa fa-refresh" style="font-size:16px"></i> Processing
                                            </a>
                                            <a href="{{ route('orders.change', ['order_id' => $order->id, 'status' => 'delivered']) }}"
                                                class="btn btn-success btn-flat btn-addon btn-xs m-b-10">
                                                <i class="fa fa-check" style="font-size:16px"></i> Completed
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
