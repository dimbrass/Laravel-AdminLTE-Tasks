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
                    <table class="table table-hover roles" style="z-index: 1;">
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
                                    <form name="role-perm-table" class="role-perm-table" action="" id="rptbl-bttn-{{ $user->id }}">

                                        <meta name="csrf-token" content="{{ csrf_token() }}">

                                        @if ($user->admin)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">admin</button>
                                            <button name="{{ $user->id }}" id="admin-{{ $user->id }}" value="admin" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif

                                        @if ($user->manager)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">manager</button>
                                            <button name="{{ $user->id }}" id="manager-{{ $user->id }}" value="manager" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif

                                        @if ($user->worker)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">worker</button>
                                            <button name="{{ $user->id }}" id="worker-{{ $user->id }}" value="worker" type="button" class="btn btn-danger">X</button>
                                        </div>
                                        @endif

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Добавить роль</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=admin">Admin</a></li>
                                                <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=manager">Manager</a></li>
                                                <li><a href="edituserroles/add/?user_id={{ $user->id }}&role=worker">Worker</a></li>
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <script>
                function removeRole(user_id, role)
                {
                        var link = 'edituserroles/del/?user_id='+ user_id +'&role='+ role;
                        $.ajax({
                                type: 'POST',
                                url: link,
                            //  data: 'role=this.value&user_id=btn.name',
                                success: function(data){
                                        $( ".btn-group #"+data ).parent().remove();
                                }
                        });
                };

                $(document).ready(function () {
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                    });

                    $('form.role-perm-table button.btn-danger').on('click', function (e)
                    {
                        var link = 'edituserroles/del/?user_id='+ this.name +'&role='+this.value;
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: link,
                          //  data: 'role=this.value&user_id=this.name',
                            success: function(data){
                                $( ".btn-group #"+data ).parent().remove();
                            }
                        });

                    });

                    $('form.role-perm-table a').on('click', function (e) {
                        var link = $(this).attr('href');
                        e.preventDefault();
                        $.ajax({
                                type: 'POST',
                                url: link,
                                dataType: 'json',
                                data: { link },
                                success: function(data) {
var newbttn = '<div class="btn-group"><button type="button" class="btn btn-default">' + data.role + '</button><button name="' + data.user_id +'" id="' + data.role + '-' + data.user_id +'" value="' + data.role + '" type="button" class="btn btn-danger">X</button></div>';
                                if (data.success == 1)
                                    $( "#rptbl-bttn-" + data.user_id ).prepend(newbttn);
                                    $( "#" + data.role + "-" + data.user_id ).on('click', function (e) {
                                        removeRole(this.name, this.value);
                                    })
                                },
                                error: function (msg) {
                                alert(data.error);
                                }
                        });
                    });
                });
                </script>

            </div>

            <div class="box-footer">
                Footer
            </div>
        </div>

@stop
