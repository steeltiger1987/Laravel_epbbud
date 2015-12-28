<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="height: 50px; text-align: left; color: white; font-size: 18px;">
            <p>Welcome, Username</p>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li id="quotation" class="active"></i><a href="#"><i class="fa fa-dollar"></i><span>Quotation</span></a></li>
            <li id="invoice"><a href="#"><i class="fa fa-file-o"></i><span>Invoice</span></a></li>
            <li id="delivery"><a href="#"><i class="fa fa-truck"></i><span>Delivery Order</span></a></li>
            <li id="inventory"><a href="#"><i class="fa fa-cubes"></i><span>Inventory</span></a></li>
            <li id="operations"><a href="#"><i class="fa fa-gear"></i><span>Operations</span></a></li>
            <li id="products"><a href="{{asset('products')}}"><i class="fa fa-cart-plus"></i><span>Products</span></a></li>
            <li id="customers"><a href="{{asset('customers')}}"><i class="fa fa-briefcase"></i><span>Customers</span></a></li>
            <li id="accounting"><a href="#"><i class="fa fa-credit-card"></i><span>Accounting</span></a></li>
            <li id="newsletter"><a href="#"><i class="fa fa-envelope-o"></i><span>Newsletter</span></a></li>
            <li id="users"><a href="{{asset('users')}}"><i class="fa fa-users"></i><span>Users</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>