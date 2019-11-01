@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Задачи</h1>
@stop

@section('content')

    <!-- Bootstrap шаблон... -->

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой задачи -->
        <form action="{{ url('task') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя задачи -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Задача</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>
            </div>

            <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить задачу
                    </button>
                </div>
            </div>
        </form>
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
