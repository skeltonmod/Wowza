<div class="col-lg-12">
    <div class="card card-outline-primary">
        <div class="card-header">
            <h4 class="m-b-0 text-white">Admin Dashboard</h4>
        </div>
        <div class="row">

            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['month'] }}</h2>
                            <p class="m-b-0">Earned this Month</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left meida media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['today'] }}</h2>
                            <p class="m-b-0">Earned this Day</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left media media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['year'] }}</h2>
                            <p class="m-b-0">Earned this Year</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left media media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['dishes'] }}</h2>
                            <p class="m-b-0">Total Dishes</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left media media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['completed'] }}</h2>
                            <p class="m-b-0">Completed Orders</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card p-30">
                    <div class="media">
                        <div class="media-left media media-middle">
                            <span><i class="fa fa-calendar f-s-40" aria-hidden="true"></i></span>
                        </div>
                        <div class="media-body media-text-right">
                            <h2>{{ $orders['rejected'] }}</h2>
                            <p class="m-b-0">Cancelled Orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
