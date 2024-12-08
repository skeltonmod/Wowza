<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-tachometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-label">Manage</li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="fa fa-user f-s-20" aria-hidden="true"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.user.customer.all') }}">All users</a></li>
                        <li><a href="{{ route('admin.user.all') }}">All cashiers</a></li>
                        <li><a href="{{ route('admin.user.add') }}">Add cashier</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="fa fa-cutlery" aria-hidden="true"></i>
                        <span class="hide-menu">Menu</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">  
                        <li><a href="{{ route('admin.dish.all') }}">All menu</a></li>
                        <li><a href="{{ route('admin.dish.category.create') }}">Add Category</a></li>
                        <li><a href="{{ route('admin.dish.create') }}">Add Menu</a></li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="hide-menu">Orders</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">  
                        <li><a href="{{ route('admin.orders') }}">Online Records</a></li>
                        <li><a href="{{ route('admin.orders.restaurant') }}">Restaurant Records</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>