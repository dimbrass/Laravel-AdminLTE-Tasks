@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Задачи</h1>
@stop

@section('content')

<!-- Форма новой задачи -->
<form action="{{ url('task') }}" method="POST" class="row form-horizontal">
{{ csrf_field() }}
<!-- Имя задачи -->
       <!-- <label for="task" class="col-sm-2 control-label">Задача</label>
-->
        <div class="col-sm-6">
            <input type="text" name="name" id="task-name" class="form-control">
        </div>

        <div class="col-sm-2">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-plus"></i> Добавить задачу
            </button>
        </div>
</form>
                                                         <br>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-tools" style="width: 100%;">
                    <div class="input-group input-group-sm hidden-xs" style="width: 100%;">
                            <label style="float: left !important">Задача: &nbsp; </label>
                            <input type="text" name="table_search" class="form-control pull-right" style="width: 65%; float: left !important" placeholder="Search">
                            <div class="input-group-btn" style="float: left !important; margin-right: 55px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>

                        <form method="GET"  action="{{ url('tasks/') }}" style="width: 220px; display: inline-block">
                            {{--                {{ csrf_field() }}     --}}
                            @if (isset($_GET['completed']))
                            <input type="hidden" name="completed" value="{{ $_GET['completed'] }}">
                            @endif
                            <label style="float: left !important">Дата: &nbsp; </label>
                            <input type="text" name="datepicker" class="form-control pull-right datepicker" autocomplete="off"
                                                style="width: 88px; float: left !important" placeholder="2019-11-31">
                            <div class="input-group-btn" style="float: left !important; margin-right: 55px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                                                                           <br>
                    <h3 class="box-title">Список задач</h3>

                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <!-- Текущие задачи -->
            @if (count($tasks) > 0)
                <table class="table table-hover tasks">
                    <tbody><tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>Задача</th>
                        <th>Создана /<br>Заверршена</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $user->first_name.' '.$user->last_name }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->created_at }} / <br>{{ $task->completed_at }}</td>
                        <td id="td-task-labels-{{ $task->id }}">
                            @if ($task->completed_at > '') <span class="label label-success">Выполнена</span> <br> @endif
                            @if ($task->completed_part > '') <span class="label label-warning">Выполнена частично</span> <br> @endif
                            @if ($task->add_time > '') <span class="label label-primary">Продлить до {{ substr($task->add_time, 0, 10) }}</span> <br> @endif
                            @if ($task->report_id > 0) <span class="label label-info link-report pointer"
                                                                data-task-name="{{ $task->name }}"
                                                                data-user-firstname="{{ $user->first_name }}"
                                                                data-user-lastname="{{ $user->last_name }}"
                                                                data-user-phones='["0","1","2"]'
                                                       >Отчет</span> <br> @endif                     <!-- $user->phones()->find(1)->phone  -->
                            @if ($task->deleted_at > '')<span class="label label-danger">Удалена</span> @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Действие</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu task-acts" role="menu" style="z-index: 0; position: absolute; margin-left: -15px;">
                                    <li><a href="task/complete/?task_id={{ $task->id }}">Выполнена</a></li>
                                    <li><a href="task/complete-part/?task_id={{ $task->id }}">Выполнена частично</a></li>
                                    <li><a href="task/add-time/?task_id={{ $task->id }}">Требуется доп.время</a></li>
                                    <li><a href="task/report/?task_id={{ $task->id }}">Заполнить отчет</a></li>
                                    <li><a href="task/delete/?task_id={{ $task->id }}">Удалить</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody></table>
            @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modalReportLabel">
    <div class="modal-dialog" role="document">
    <form class="needs-validation" novalidate="">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="modalReportH3">Task</h3>
            </div>
            <div class="modal-body">

                    <label for="address">Описание выплненной работы</label>
                    <textarea class="form-control" id="comment-worker" placeholder="" name="comment-worker" rows="2"></textarea>

                    <hr class="mb-4">

                    <div class="row">
                        <h4 class="modal-title" id="modalReportH3" style="margin-left: 14px;">Исполнитель</h4>
                        <div class="col-md-4 mb-3">
                            <label for="firstName">Имя</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="" disabled="disabled">
                           <!-- <div class="invalid-feedback">
                                Valid first name is required.
                            </div>-->
                        </div>
                        <div class="col-md-5 mb-3">
                            <label for="lastName">Фамилия</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="" disabled="disabled">
                            <!--<div class="invalid-feedback">
                                Valid last name is required.
                            </div>-->
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="phones">Телефоны</label>
                            <input type="text" class="form-control phone" id="phone" placeholder="1234 Main St" required="">
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="mb-3">
                        <label for="address">Адрес заказа</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                    </div>
                                                          <br>
                    <div class="mb-3">
                        <label for="address">Телефоны заказчика</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                    </div>
                                                                 <br>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Заказчику выдана дисконтная карта</label>
                    </div>

                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address">Комментарий исполнителя</label>
                            <textarea class="form-control" id="comment-worker" placeholder="" name="comment-worker" rows="2"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Комментарий Заказчика</label>
                            <textarea class="form-control" id="comment-worker" placeholder="" name="comment-worker" rows="2"></textarea>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="modal-footer row">
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-default btn-md btn-block" type="submit" data-dismiss="modal">Закрыть</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button class="btn btn-primary btn-md btn-block" type="submit">Сохранить</button>
                        </div>
                    </div>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
$(document).ready(function () {
        $('.link-report').on('click', function (e) {
        var arr_phones = [];
            taskname = $(this).data('task-name');
            firstname = $(this).data('user-firstname');
            lastname = $(this).data('user-lastname');
            phones = $(this).data('user-phones');            //   alert(phones[1]);



            $('#modalReportH4').html(taskname);
            $('#modalReport #firstName').val(firstname);
            $('#modalReport #lastName').html(lastname);
            $('#modalReport').modal('show');
        });

        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                contentType: "application/json; charset=utf-8"
        });

        $('ul.task-acts a').on('click', function (e) {
                var link = $(this).attr('href');
                e.preventDefault();

                if (link.substr(5, 8) == 'add-time') {
                    var add_time = prompt("Введите дополнительную дату завершения задачи:", "2019-11-22");
                    if (add_time > "") {
                        link = link + "&add_time=" + add_time;
                    }
                }
                if (link.substr(5, 6) == 'report') {
                    $('#modalReportLabel').html('{{ $task->name }}');
                    $('#modalReport').modal('show');
                }

                $.ajax({
                                type: 'POST',
                                url: link,
                                dataType: 'json',
                                data: JSON.stringify({link}),
                                success: function(data) {                      // alert(data.task_id);
                                    var newlabel = '';
                                    switch (data.act) {
                                        case 'complete':
                                            newlabel = '<span class="label label-success">Выполнена</span><br>';
                                            break;
                                        case 'complete_part':
                                            newlabel = '<span class="label label-warning">Выполнена частично</span><br>';
                                            break;
                                        case 'add_time':
                                            newlabel = '<span class="label label-primary">Продлить до ' + data.add_time.substr(0, 22) + '</span><br>';
                                            break;
                                        case 'report':
                                            newlabel = '<span class="label label-info">Отчет</span><br>';
                                            break;
                                        case 'delete':
                                            newlabel = '<span class="label label-danger">Удалена</span><br>';
                                            break;
                                    }
                                    $( "#td-task-labels-" + data.task_id ).prepend(newlabel);
                                },
                                error: function (msg) {
                                alert(data.error);
                                }
                });
        });
});
</script>
                    <a class="nav-link" href="/tasks">Текущие задачи <span class="sr-only">(current)</span></a>
                    <a class="nav-link" href="/tasks?completed=1">Выполненные задачи</a>
@endsection
