<ul class="nav navbar-nav">
    @if(isset(Auth::user()->get()->id) OR isset(Auth::applicant()->get()->id))
        @include('layouts._top_menu_notification')
    @endif
    <!-- User Account: style can be found in dropdown.less -->

    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{--<i class="glyphicon glyphicon-user"></i>--}}
            <span><b> {{ isset(Auth::user()->get()->username) ? ucwords(Auth::user()->get()->username) : ( Auth::applicant()->check() ? ucwords(Auth::applicant()->get()->username) : "Guest !" ) }} </b> <i class="caret"></i></span>
        </a>
        <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
                {{ HTML::image('/img/avatar3.png', 'User Image', ['class'=>'img-circle']) }}
                <p>
                    <b> {{ isset(Auth::user()->get()->username) ? ucwords(Auth::user()->get()->username) : ( Auth::applicant()->check() ? ucwords(Auth::applicant()->get()->username) : "Guest !" ) }} </b>
                    <small>Last Visit : {{ isset(Auth::user()->get()->last_visit) ? Auth::user()->get()->last_visit : ( Auth::applicant()->check() ? ucwords(Auth::applicant()->get()->last_visit) : "Guest !" ) }}</small>
                </p>
            </li>
            <!-- Menu Footer-->
            @if(isset(Auth::user()->get()->id) OR isset(Auth::applicant()->get()->id))
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="{{URL::route('user/user-access-to') }}" class="btn btn-default btn-flat">Dashboard</a>
                    </div>
                    <div class="pull-left">
                        <a href="{{URL::route('user/profile') }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-left">
                        <a href="{{URL::route('user/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            @else
                <li class="user-footer">
                    <div class="pull-right">
                        <a href="{{URL::route('user/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            @endif
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
           <i class='fa fa-gear'></i><i class="caret"></i>
        </a>
        <ul class="dropdown-menu">
           <div style="text-align: center;background-color:lavender"><b>Account & Settings</b></i>
              <p>&nbsp;</p>
           </div>
           <li><a href="{{ URL::route('user/logout') }}">Sign out</a></li>
           <li><a href="{{ URL::to('user/settings') }}">Privacy Settings </a></li>
        </ul>
    </li>
</ul>
