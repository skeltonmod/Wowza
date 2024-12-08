@php
use Faker\Factory as Faker;

$faker = Faker::create();

// Simulate order data
$order = [
    'username' => $faker->userName,
    'title' => $faker->sentence(3),
    'quantity' => $faker->numberBetween(1, 10),
    'price' => $faker->randomFloat(2, 100, 1000),
    'address' => $faker->address,
    'date' => $faker->dateTimeThisYear->format('Y-m-d H:i:s'),
    'status' => $faker->randomElement(['', 'preparing', 'in process', 'closed', 'rejected']),
    'o_id' => $faker->unique()->randomNumber(5),
];
@endphp

<div class="row">
    <div class="col-12">
        <div class="col-lg-12">
            <div class="card card-outline-primary">
                <div class="card-header">
                    <h4 class="m-b-0 text-white">View Order</h4>
                </div>

                <div class="table-responsive m-t-20">
                    <table id="myTable" class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td><strong>Username:</strong></td>
                                <td>
                                    <center>{{ $order['username'] }}</center>
                                </td>
                                <td>
                                    <center>
                                        <a onClick="popUpWindow('order_update.php?form_id={{ $order['o_id'] }}');" title="Update order">
                                            <button type="button" class="btn btn-primary">Update Order Status</button>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Title:</strong></td>
                                <td>
                                    <center>{{ $order['title'] }}</center>
                                </td>
                                <td>
                                    <center>
                                        <a href="javascript:void(0);" onClick="popUpWindow('userprofile.php?newform_id={{ $order['o_id'] }}');" title="Update order">
                                            <button type="button" class="btn btn-primary">View User Details</button>
                                        </a>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Quantity:</strong></td>
                                <td>
                                    <center>{{ $order['quantity'] }}</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Price:</strong></td>
                                <td>
                                    <center>₱{{ number_format($order['price'], 2) }}</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>
                                    <center>{{ $order['address'] }}</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date:</strong></td>
                                <td>
                                    <center>{{ $order['date'] }}</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <center>
                                        @if ($order['status'] === '' || $order['status'] === 'NULL')
                                            <span class="text-info"><i class="fa fa-bars" aria-hidden="true"></i> Dispatch</span>
                                        @elseif ($order['status'] === 'preparing')
                                            <span class="text-warning"><i class="fa fa-cog fa-spin" aria-hidden="true"></i> In Process</span>
                                        @elseif ($order['status'] === 'in process')
                                            <span class="text-warning"><i class="fa fa-truck" aria-hidden="true"></i> On the Way!</span>
                                        @elseif ($order['status'] === 'closed')
                                            <span class="text-primary"><i class="fa fa-check-circle" aria-hidden="true"></i> Delivered</span>
                                        @elseif ($order['status'] === 'rejected')
                                            <span class="text-danger"><i class="fa fa-close"></i> Cancelled</span>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
