
<ul class="sidebar-menu">
    <li>
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
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



</ul>

