
<ul class="sidebar-menu">
    <li class="active">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-leaf" style="color: #09b021"></i>
            <span>Sign up and Sign In</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="">
                <a href="{{ URL::route('user/sign') }}">
                    <i class="fa fa-dashboard"></i> <span>Sign In</span>
                </a>
            </li>
            <li class="">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>User Sign Up</span>
                </a>
            </li>
            <li class="">
                <a href="{{ URL::to('applicant/registration') }}">
                    <i class="fa fa-dashboard"></i> <span>Applicant Sign Up</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-leaf" style="color: #09b021"></i>
            <span>Common</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Common</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-download" style="color: #803a0f"></i>
            <span>Admission</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a tabindex="-1" a href="{{ URL::route('admission.public.degree_offer_list') }}"></i><i class="fa fa-globe" style="color:#0089db"></i>Apply For Admission Test</a></li>
        </ul>

    </li>


</ul>