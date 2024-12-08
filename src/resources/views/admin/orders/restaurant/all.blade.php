<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">All Orders</h4>
                </div>

                <div class="table-responsive m-t-40">
                    <div style="overflow-x: auto;">
                        <table id="myTable" class="table table-bordered table-striped" style="min-width: 1000px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Order</th>
                                    <th>Order</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date Ordered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="6">
                                            <center>There are no placed orders yet.</center>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $order->user->name }}
                                            </td>
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
                                                    <span class="text-info">
                                                        <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                    </span>
                                                @elseif($status == 'pending')
                                                    <span class="text-warning">
                                                        <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                                        Preparing!
                                                    </span>
                                                @elseif($status == 'processing')
                                                    <span class="text-warning">
                                                        <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On
                                                        The Way!
                                                    </span>
                                                @elseif($status == 'delivered')
                                                    <span class="text-success">
                                                        <span class="fa fa-check-circle" aria-hidden="true"></span>
                                                        Delivered
                                                    </span>
                                                @elseif($status == 'rejected')
                                                    <span class="text-danger">
                                                        <i class="fa fa-close"></i> Cancelled
                                                    </span>
                                                @endif
                                            </td>
                                            <td data-column="Date">{{ $order->created_at }}</td>
                                            <td data-column="Action">
                                                <a href="{{ route('receipt.show', $order->id) }}"
                                                    class="btn btn-info btn-flat btn-addon btn-xs m-b-10">
                                                    <i class="fa fa-file-text-o" style="font-size:16px"></i> Show
                                                    Receipt
                                                </a>
                                                <a href="{{ route('receipt.pdf', $order->id) }}"
                                                    class="btn btn-success btn-flat btn-addon btn-xs m-b-10">
                                                    <i class="fa fa-download" style="font-size:16px"></i> Download PDF
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
</div>
