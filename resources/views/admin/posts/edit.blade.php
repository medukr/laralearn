@extends('admin.layout')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Изменить статью
                <small>приятные слова..</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{ Form::open([
            'route' => ['posts.update', $post->id],
            'files' => true,
            'method' => 'put'
        ]) }}
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Обновляем статью</h3>
                    @include('admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title" value="{{ $post->title }}">
                        </div>

                        <div class="form-group">
                            <img src="{{ $post->getImage() }}" alt="" class="img-responsive" width="">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" id="exampleInputFile" name="image">

                            <p class="help-block">Какое-нибудь уведомление о форматах..</p>
                        </div>
                        <div class="form-group">
                            <label>Категория</label>
                            {{ Form::select('category_id',
                                $categories,
                                $post->getCategoryID(),
                                ['class' => 'form-control select2',
                                 'style' => 'width: 100%',
                                 'placeholder' => 'Выберите категорию'
                                ])
                            }}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{ Form::select('tags[]',
                                [$tags],
                                $selectedTags,
                                ['class' => 'form-control select2',
                                 'multiple' => 'multiple',
                                 'data-placeholder' => 'Выберите теги',
                                 'style' => 'width: 100%'])
                            }}
                        </div>
                        <!-- Date -->
                        {{--<div class="form-group">--}}
                            {{--<label>Дата:</label>--}}

                            {{--<div class="input-group date">--}}
                                {{--<div class="input-group-addon">--}}
                                    {{--<i class="fa fa-calendar"></i>--}}
                                {{--</div>--}}
                                {{--<input type="text" name="date" class="form-control pull-right" id="datepicker" value="{{ $post->date }}">--}}
                            {{--</div>--}}
                            {{--<!-- /.input group -->--}}
                        {{--</div>--}}

                        <div class="form-group">
                            <label for="date">Дата публикации:</label>
                            <div class='input-group date' id='datetimepicker'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                <input type='text' class="form-control" value="{{ $post->date }}" name="date">
                            </div>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                {{ Form::checkbox('is_featured', 1, $post->is_featured, ['class' => 'minimal']) }}
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                {{ Form::checkbox('status', 1, $post->status, ['class' => 'minimal']) }}
                            </label>
                            <label>
                                Публиковать
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control ckeditor">{{ $post->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10" class="form-control ckeditor">{{ $post->content }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
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