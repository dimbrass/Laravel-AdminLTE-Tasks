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
                                    <form name="role-perm-table" action="">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Admin</button>
                                            <button name="role" value="del-admin" type="button" class="btn btn-danger">X</button>
                                        </div>
                                                                    &nbsp;
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Manager</button>
                                            <button name="role" value="del-manager" type="button" class="btn btn-danger">X</button>
                                        </div>
                                                                    &nbsp;
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Worker</button>
                                            <button name="role" value="del-worker" type="button" class="btn btn-danger">X</button>
                                        </div>
                                                                    &nbsp;
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default">Добавить роль</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="z-index: 0; position: absolute; margin-left: -15px;">
                                                <li><a href="#">Admin</a></li>
                                                <li><a href="#">Manager</a></li>
                                                <li><a href="#">Worker</a></li>
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                Pace loading works automatically on page. You can still implement it with ajax requests by adding this js:
                <br><code>$(document).ajaxStart(function() { Pace.restart(); });</code>
                <br>
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                            <i class="fa fa-spin fa-refresh"></i>&nbsp; Get External Content
                        </button>
                    </div>
                </div>
                <div class="ajax-content"><hr>Ajax Request Completed !</div>

            </div>

            <div class="box-footer">
                Footer
            </div>
        </div>

@stop