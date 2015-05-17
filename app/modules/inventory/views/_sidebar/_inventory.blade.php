<ul class="sidebar-menu">
    <li class="active">
        <a href="index.html">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i><span> Inventory </span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{URL::route('product')}}"><i class="fa fa-angle-double-right"></i> Product Master</a></li>
            <li><a href="{{URL::route('product/category')}}"><i class="fa fa-angle-double-right"></i> Product Category</a></li>
            <li><a href="{{URL::route('supplier')}}"><i class="fa fa-angle-double-right"></i> Supplier Master</a></li>
            <li><a href="{{URL::route('requisition')}}"><i class="fa fa-angle-double-right"></i> Requisition</a></li>
        </ul>
    </li>

</ul>
