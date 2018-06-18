@extends('layout')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="leave-comment mr0"><!--leave comment-->
                        <h3 class="text-uppercase">My profile</h3>
                        <br>
                        <img src="{{$user->getAvatar()}}" alt="" class="profile-image">
                        <form class="form-horizontal contact-form" role="form" method="post" action="/profile" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="avatar">Аватар</label>
                                    <input type="file" id="image" name="avatar">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Name" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Email" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="user_status">Статус</label>
                                    <textarea name="user_status" id="" rows="2" class="form-control">{{ $user->user_status }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="password">Изменить пароль</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn send-btn">Update</button>

                        </form>
                    </div><!--end leave comment-->
                </div>
                @include('pages._sidebar')
            </div>
        </div>
    </div>
@endsection