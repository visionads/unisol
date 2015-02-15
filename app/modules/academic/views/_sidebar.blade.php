
@if((Role::find(Auth::user()->role_id)->title)=='amw')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-user">
                    </span>You are loggged in as <strong>{{ ucwords(Auth::user()->username) }} </strong></a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">

                    <tr>
                        <td>
                            <a href="{{ action('AcmAmwController@amw_index') }}">All Item List</a> <span class="label label-success"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="{{ action('AcmAmwController@config_index') }}">Course Config</a> <span class="label label-info"></span>
                        </td>

                    </tr>

                </table>
            </div>
        </div>
    </div>

@elseif((Role::find(Auth::user()->role_id)->title)=='faculty')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-in">
                        </span>You are loggged in as <strong>{{ ucwords(Auth::user()->username) }} </strong></a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="{{ action('AcmFacultyController@index') }}">Mark Distribution</a> <span class="label label-success"></span>
                        </td>
                    </tr>
                    {{--<tr>--}}
                    {{--<td>--}}
                    {{--<a href="{{ action('SemesterController@create') }}">Create New Semester</a> <span class="label label-info"></span>--}}
                    {{--</td>--}}

                    {{--</tr>--}}

                </table>
            </div>
        </div>
    </div>





@endif