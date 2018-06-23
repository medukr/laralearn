@extends('admin.layout')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
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
                    <h3 class="box-title">Листинг сущности</h3>
                    @include('admin.errors')
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('posts.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Картинка</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->getCategoryTitle() }}</td>
                            <td>{{ $post->getTagsTitles() }}</td>
                            <td>
                                <img src="{{ $post->getImage() }}" alt="" width="100">
                            </td>
                            <td>
                                @if($post->getPostStatus() == \App\Post::IS_DRAFT)
                                    <span class="badge alert-danger">Черновик</span>
                                @elseif($post->getPostStatus() == \App\Post::IS_PUBLIC)
                                    <span class="badge alert-success">Опубликовано</span>
                                @else
                                    <span class="badge alert-warning">Ожидает</span>
                                @endif
                            </td>
                            <td><a href="{{ route('posts.edit', $post->id) }}" class="fa fa-pencil"></a>
                                {{Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete'])}}
                                <button class="delete" onclick="if (!confirm('Are you sure?')) return false"><i class="fa fa-remove"></i></button>
                            {{Form::close()}}
                                @if($post->status == 1)
                                    <a href="/post/{{$post->slug}}" title="Перейти к посту"><i class="fa fa-newspaper-o"></i></a>
                                @else
                                    <a href="/post/{{$post->slug}}" title="Предпросмотр"><i class="fa fa-puzzle-piece"></i></a>
                                @endif
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