<ul class="sidebar-menu">
    <li>
        <a href="{{URL::to('user/amw-dashboard')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
       <a href="#">
           <i class="fa  fa-male" style="color: #0072b1"></i>
           <span>Accounts</span>
           <i class="fa fa-angle-left pull-right"></i>
       </a>
       <ul class="treeview-menu">
            <li><a href="{{ URL::to('user/profile-info') }}">Personal Information</a></li>
            <li><a href="{{ URL::to('user/meta-data') }}"> Biographical Information </a></li>
            {{--<li><a href="{{ URL::to('user/supporting-docs') }}"> Supporting Documents </a></li>--}}
            {{--<li><a href="{{ URL::to('user/extra-curricular') }}"> Extra-Curricular Activities </a></li>--}}
            {{--<li><a href="{{ URL::to('user/misc-info') }}"> Miscellaneous Information </a></li>--}}
       </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-leaf" style="color: #09b021"></i>
            <span>Common</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ URL::to('common/year/') }}"> Year </a></li>
            <li><a href="{{ URL::to('common/semester/') }}"> Semester </a></li>
            <li><a href="{{ URL::to('common/subject/') }}"> Subject </a></li>
            <li><a href="{{ URL::to('common/department/') }}"> Department </a></li>

            <li><a href="{{ URL::to('common/adm_test_subject') }}"> Admission Test Subject </a></li>
            <li><a href="{{ URL::to('common/course') }}"> Course </a></li>

            <li><a href="{{ action('DegreeProgramController@degreeProgramIndex') }}"> Degree Program  </a></li>
            <li><a href="{{ action('DegreeGroupController@degreeGroupIndex') }}"> Degree Group </a></li>
            <li><a href="{{ action('ExamCenterController@exmCenterIndex') }}"> Exam Center </a></li>
            <li><a href="{{ action('CourseTypeController@index') }}"> Course Type </a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-download" style="color: #803a0f"></i>
            <span>Admission</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ URL::to('admission/amw/degree') }}"></i><i class="fa fa-flask" style="color: #db4509"></i> Degree</a></li>
            <li><a href="{{ URL::to('admission/amw/admission-test-home') }}"></i><i class="fa fa-flask" style="color: #db4509"></i> Admission Test</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-book text-purple"></i>
            <span>Academic</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ URL::to('academic/amw/config/') }}"></i><i class="fa fa-stack-overflow text-blue"></i> Courses</a></li>
            <li><a href="{{ URL::to('common/exm-center') }}"></i><i class="fa fa-qrcode text-green"></i> Exam Center</a></li>
        </ul>
    </li>

    <li class="treeview">
            <a href="#">
                <i class="fa fa-pencil" style="color:deepskyblue"></i>
                <span>Examination</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ URL::to('examination/amw/exam-list') }}"></i><i class="fa fa-list text-blue"></i> Exam List</a></li>
                {{--<li><a href="{{ URL::to('admission/amw/admission-test-home') }}"></i><i class="fa fa-flask" style="color: #db4509"></i> Admission Test</a></li>--}}
            </ul>
        </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-credit-card text-yellow" style="color:deepskyblue"></i>
            <span>Fees</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ URL::to('fees/billing/item') }}"><i class="fa  fa-bars text-green"></i> Billing Item</a></li>

            <li><a href="{{ URL::to('fees/billing/schedule') }}"><i class="fa  fa-bars text-light-blue"></i> Billing Schedule</a></li>

            <li><a href="{{ URL::to('fees/billing-applicant') }}"><i class="fa  fa-bars text-olive"></i> Applicant (Fees) </a></li>

            <li><a href="{{URL::to('fees/billing-student')}}"><i class="fa fa-bars text-yellow"></i> Student (Fees) </a></li>

            <li><a href="{{ URL::to('fees/billing/setup') }}"><i class="fa  fa-bars text-red"></i> Billing Setup</a></li>

            <li><a href="{{ URL::to('fees/installment/setup') }}"><i class="fa  fa-bars text-blue"></i>Installment Setup</a></li>
        </ul>
    </li>

    <li class="treeview">
            <a href="#">
                <i class="fa fa-credit-card" style="color: rgba(2, 128, 125, 0.85)"></i>
                <span>Research & Consultancy</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{ URL::to('rnc/amw/category/index') }}"></i><i class="fa fa-puzzle-piece" style="color: #0effae"></i>Category</a></li>
                <li><a href="{{ URL::to('rnc/amw/config/index') }}"></i><i class="fa fa-cogs" style="color: #c69bff"></i>Config</a></li>
                <li><a href="{{ URL::to('rnc/amw/publisher/index') }}"></i><i class="fa fa-print" style="color: #ff1465"></i>Publisher</a></li>
                <li><a href="{{ URL::to('rnc/amw/research-paper/index') }}"></i><i class="fa fa-fire-extinguisher" style="color: rgb(219, 94, 17)"></i>Research Paper</a></li>

            </ul>
        </li>
        @include('accounts::_sidebar._accounts')
        @include('inventory::_sidebar._inventory')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-credit-card"></i>
                <span>HRM</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                @include('hr::_sidebar._hr')
            </ul>
        </li>



</ul>


