@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить комментарий
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{ Form::open([
            'route' => ['comments.update', $comment->id],
            'method' => 'put'
        ]) }}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем комментарий</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="text">Текст комментария</label>
                            <textarea name="text" id="" cols="30" rows="10" class="form-control">{{ $comment->text }}</textarea>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{ Form::close() }}
        </section>
        <!-- /.content -->
    </div>
@endsection