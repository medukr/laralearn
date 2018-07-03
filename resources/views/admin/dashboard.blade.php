@extends('admin.layout')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Привет! Это админка
            <small>приятные слова..</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Главная страница</h3>
            </div>
            <div class="box-body">
                Текст инструкции по пользованию админкой
                <div>
                    <h3>Cменить язык меню</h3>
                    <a href="{{route('language.change', 'en')}}" class="btn btn-info">EN</a>
                    <a href="{{route('language.change', 'ru')}}" class="btn btn-info">РУС</a>
                    <h4>Проверка:</h4>
                    @lang('messages.welcome')
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                и здесь есть место для какого-нибудь текста
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
@endsection