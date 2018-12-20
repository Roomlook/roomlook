@extends($layout)
<?php
use \App\Models\Project;

$projects = Project::orderBy('id', 'DESC')->get();
$roomsWithTags = [];
$projectsWithTags = [];

// Searching for projects that have tags
foreach ($projects as $project) {
    $rooms = $project->rooms;
    $hasRoomWithTags = false;

    foreach ($rooms as $room) {
        if (sizeof($rooms) > 0) {
            if (!$hasRoomWithTags) {
                foreach ($room->pictures as $picture) {
                    if (!$hasRoomWithTags) {
                        if (sizeof($picture) > 0) {
                            foreach ($picture->tags as $tag) {
                                if (sizeof($tag) > 0) {
                                    array_push($projectsWithTags, $project);
                                    $hasRoomWithTags = true;
                                    break;
                                } else {
                                    continue;
                                }
                            }
                        } else {
                            continue;
                        }
                    } else {
                        break;
                    }

                }
            } else {
                break;
            }

        } else {
            continue;
        }
    }
}


?>
@section('content-header')
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
@stop

@section('content')

    <div class="col-12">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            {!! user()->count() !!}
                        </h3>

                        <p>
                            Все пользователи
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{!! route('admin.users.index') !!}" class="small-box-footer">
                        Подробнее <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            {!! App\Models\Project::all()->count() !!}
                        </h3>

                        <p>
                            Проекты
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="/admin/projects" class="small-box-footer">
                        Подробнее <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                            {!! App\Models\Room::all()->count() !!}
                        </h3>

                        <p>
                            Комант
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-flag"></i>
                    </div>
                    <a href="/admin/rooms" class="small-box-footer">
                        Подробнее <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            {!! App\Models\Product::all()->count() !!}
                        </h3>

                        <p>
                            товаров
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="/admin/products" class="small-box-footer">
                        Подробнее <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <div class="col-12">
                <h3>Выберите проект для превью на главной странице</h3>
                <select name="projectName" id="">
                    <?php foreach($projectsWithTags as $project) { ?>
                    <option value="<?php echo $project->id?>"><?php echo $project->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
@stop

@section('script')
    <script src="{!! admin_asset('components/raphael/raphael-min.js') !!}"></script>
    <script src="{!! admin_asset('adminlte/js/plugins/morris/morris.min.js') !!}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{!! admin_asset('adminlte/js/AdminLTE/dashboard.js') !!}" type="text/javascript"></script>

@stop
