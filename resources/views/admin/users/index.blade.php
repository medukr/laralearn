@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Пользователи
                <small>все для пользователей</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список пользователей</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('users.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>E-mail</th>
                            <th>Аватар</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <img src="{{$user->getAvatarMini()}}" alt="" class="img-responsive" width="90">
                            </td>
                            <td>
                                @if($user->status == 0)
                                    <a href="/admin/users/toggle/{{$user->id}}" class="fa fa-lock" title="Запретить"></a>
                                @else
                                    <a href="/admin/users/toggle/{{$user->id}}" class="fa fa-thumbs-o-up" title="Разрешить"></a>
                                @endif
                                <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a>
                                {{Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete'])}}
                                <button class="delete" onclick="if (!confirm('Are you sure?')) return false"><i class="fa fa-remove"></i></button>
                                {{Form::close()}}
                            </td>

                        </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection