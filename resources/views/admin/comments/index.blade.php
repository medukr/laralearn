@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Комментарии
                <small>модерацию комментариев можно проводить сдесь</small>
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
                    <h3 class="box-title">Листинг комментариев</h3>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Текст</th>
                            <th>Дата</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{$comment->text}}</td>
                            <td>{{$comment->getDate()}}</td>
                            <td>
                            <a href="{{ route('post.show', $comment->post->slug) }}" title="Посмотреть пост"><i class="fa fa fa-newspaper-o"></i></a>
                            <a href="{{route('users.edit', $comment->author->id)}}" title="Посмотреть пользователя"><i class="fa fa-user"></i></a>
                                @if($comment->status == 1)
                                    <a href="/admin/comments/toggle/{{$comment->id}}" class="fa fa-lock" title="Запретить комментарий"></a>
                                @else
                                    <a href="/admin/comments/toggle/{{$comment->id}}" class="fa fa-thumbs-o-up" title="Разрешить комментарий"></a>
                                @endif
                                    <a href="{{route('comments.edit', $comment->id)}}" class="fa fa-pencil" title="Редактировать комментарий"></a>
                                    {{Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'delete'])}}
                                    <button class="delete" onclick="if (!confirm('Are you sure?')) return false" title="Удалить комментарий"><i class="fa fa-remove"></i></button>
                            {{Form::close()}}
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection