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
                            <input type="text" name="table_search" class="form-control pull-right" style="width: 40%; float: left !important" placeholder="Search">
                            <div class="input-group-btn" style="float: left !important; margin-right: 55px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>

                        <div style="width: 220px; display: inline-block">
                            <label style="float: left !important">Создана: &nbsp; </label>
                            <input type="text" name="table_search" class="form-control pull-right" style="width: 77px; float: left !important" placeholder="Search">
                            <div class="input-group-btn" style="float: left !important; margin-right: 55px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                        <div style="width: 220px; display: inline-block">
                            <label style="float: left !important">Выполнена: &nbsp; </label>
                            <input type="text" name="table_search" class="form-control pull-right" style="width: 77px; float: left !important" placeholder="Search">
                            <div class="input-group-btn" style="float: left !important; margin-right: 55px">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
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
                        <th>Создана/Заверршена</th>
                        <th>Статус</th>
                        <th>Задача</th>
                        <th>Действие</th>
                    </tr>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $task->created_at }} / {{ $task->completed_at }}</td>
                        <td>
                            <span class="label label-success">Выполнена</span>  <br>
                            <span class="label label-warning">Выполнена частично</span>   <br>
                            <span class="label label-primary">Отчет</span>  <br>
                            <span class="label label-danger">Удалена</span>
                        </td>
                        <td>{{ $task->name }}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default">Действие</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu" style="z-index: 0; position: absolute; margin-left: -15px;">
                                    <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=admin">Выполнена</a></li>
                                    <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=admin">Выполнена частично</a></li>
                                    <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=manager">Требуется доп.время</a></li>
                                    <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=worker">Заполнить отчет</a></li>
                                    <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=manager">Удалить</a></li>
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




    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!--
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        -->

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/tasks">Текущие задачи <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/tasks?completed=1">Выполненные задачи</a>
                </li>
            </ul>
            <form method="GET"  action="{{ url('tasks/') }}" class="form-inline my-2 my-lg-0  mr-3" id="sandbox-container">
                {{--                {{ csrf_field() }}     --}}
                @if (isset($_GET['completed']))
                <input type="hidden" name="completed" value="{{ $_GET['completed'] }}">
                @endif
                <input type="text" class="form-control  mr-sm-2" name="datepicker" autocomplete="off">
                <button class="btn btn-secondary my-2 my-sm-0 mr-sm-2" type="submit">Искать по дате</button>
            </form>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Задача">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Искать задачу</button>
            </form>
        </div>
    </nav>

    <!-- Текущие задачи -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th> </th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <!-- Имя задачи -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <td>
                                <!-- Кнопка Удалить -->
                                <form action="{{ url('task/'.$task->id) }}" method="POST" class="float-right">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" id="delete-task-{{ $task->id }}" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Удалить
                                    </button>
                                </form>
                                &nbsp; &nbsp; &nbsp;
                                <!-- Кнопка Выполнена -->
                                @if ($task->completed_at == '')
                                    <form action="{{ url('task/'.$task->id) }}" method="POST" class="float-right mr-3">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}

                                        <button name="complete" type="submit" id="put-task-{{ $task->id }}" class="btn btn-success" value="complete">
                                            <i class="fa fa-btn fa-trash"></i>Выполнить
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
