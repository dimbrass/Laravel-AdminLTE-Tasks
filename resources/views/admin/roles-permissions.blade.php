@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

        <div class="box">
            <!-- Отображение ошибок проверки ввода -->
            @include('common.errors')

            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>

                                                 <br style="clear: both"><br><br>
                <div class="box-tools">
                        <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                        </div>
                </div>
            </div>

            <div class="box-body">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" style="z-index: 1;">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th style="text-align: right">Status</th>
                            </tr>

                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td style="text-align: right">
                                    <form name="role-perm-table" class="role-perm-table" action="">
                                        {{ csrf_field() }}

                                        @if ($user->admin)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Admin</button>
                                            <button name="role" value="del-admin" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif
                                                                    &nbsp;
                                        @if ($user->manager)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Manager</button>
                                            <button name="role" value="del-manager" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif
                                                                    &nbsp;
                                        @if ($user->worker)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Worker</button>
                                            <button name="role" value="del-worker" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif
                                                                    &nbsp;
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Добавить роль</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="z-index: 0; position: absolute; margin-left: -15px;">
                                                <li><a href="/addrole/?user_id={{ $user->id }}&role=admin">Admin</a></li>
                                                <li><a href="/ajax/addrole/?user_id={{ $user->id }}&role=manager">Manager</a></li>
                                                <li><a href="/ajax/addrole.php/?user_id={{ $user->id }}&role=worker">Worker</a></li>
                                            </ul>
                                        </div>
                    <li><a href="/addrole/?user_id={{ $user->id }}&role=admin">Admin</a></li>
                    <li><a href="/ajax/addrole/?user_id={{ $user->id }}&role=manager">Manager</a></li>
                    <li><a href="/ajax/addrole.php/?user_id={{ $user->id }}&role=worker">Worker</a></li>

                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <script>
                $(document).ready(function () {
                    $('form.role-perm-table a').on('click', function (e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: '/addrole',                                         //  $(this).attr('href')
                            //data: $('form.role-perm-table').serialize(),
                            data:{name:'name'},
                            success:function(data){
                              alert(data.success);
                              }
                        });

                        $.post($(this).attr('href'), function(data) {
                            alert("Data Loaded: " + data);
                        });                                                     // alert($(this).attr('href'));
                    });


                });



/*                $('body').on('click', 'form.role-perm-table a', function(event)  {
                    event.preventDefault();
                    //alert($(this).attr('href'));
                });*/
                </script>

            </div>

            <div class="box-footer">
                Footer
            </div>
        </div>

@stop
