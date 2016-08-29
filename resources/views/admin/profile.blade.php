@extends('layouts.admin')
@section('title',"Profile")
@section('title','Profile')
@push('links')
<style>
    .form-group #image_file {
        margin: auto;
    }

    .form-group {
        text-align: center;
    }

    .form-group button {
        background-color: #3c8dbc;
        border-color: #367fa9;
        border: 1px solid transparent;
    }

    .form-group button:hover {
        background-color: #367fa9;
        border-color: #204d74;
        color: #fff;
        border: 1px solid transparent;
    }

    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }

    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }

</style>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <form action="profile/upload" enctype="multipart/form-data" method="post">
                    <div class="box-body box-profile">
                        <img id="blah" class="profile-user-img img-responsive img-circle"
                             src="{{ $admin->link_image ? " $admin->link_image" : "/img/nullavt.png" }}"
                             alt="User profile picture">


                        {{ csrf_field() }}
                        <div class="form-group fileUpload">
                            {{--<buttonn>asdasd</buttonn>--}}
                            <input type="file" class="upload" id="image_file" name="image_file" value="upload">
                            <button class="btn btn-primary"><i class="fa fa-edit"> Sửa</i></button>

                        </div>

                        <h3 class="profile-username text-center">{{ $admin->name }}</h3>

                        <p class="text-muted text-center">{{ $admin->email }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="pull-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>

                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-edit"></i><b>Thay
                                đổi</b></button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                <p class="text-muted">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                <p>
                    <span class="label label-danger">UI Design</span>
                    <span class="label label-success">Coding</span>
                    <span class="label label-info">Javascript</span>
                    <span class="label label-warning">PHP</span>
                    <span class="label label-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-body box-profile">

                <h3>Thông tin người dùng</h3>
                @if(session('success'))
                    <div class="alert alert-info alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        <i class="fa fa-coffee"></i>
                        {{session('success')}}
                    </div>
                @endif

                @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissable">
                        <a class="panel-close close" data-dismiss="alert">×</a>
                        <i class="fa fa-coffee"></i>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form-horizontal" role="form" method="post" action="{{ url('/admin/profile') }}">
                    {{csrf_field()}}
                    {{method_field('put')}}
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Tên người dùng :</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $admin->name }}" type="text" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" value="{{ $admin->email }}" type="text" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mật khẩu: </label>
                        <div class="col-lg-8">
                            {{--<input class="form-control" value="123456789" type="password">--}}


                            <div class="input-group">
                                <input type="password" class="form-control" value="123456789" disabled>
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                          data-target="#myModal">Go!</button>
                                </span>
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Quyền:</label>
                        <div class="col-lg-8">
                            <div class="ui-select">
                                <select class="form-control" name="role" {{Auth::user()->isAdmin() ? '' : 'disabled'}}>
                                    <option value="0" {{ ($admin->role === 0) ? 'selected' : '' }}>User</option>
                                    <option value="1" {{ ($admin->role === 1) ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ ($admin->role === 2) ? 'selected' : '' }}>Author</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Ngày sinh:</label>
                        <div class="col-md-8">
                            <input class="form-control"
                                   value="{{ isset($admin->birthday) ? $admin->birthday : '' }}" type="date"
                                   name="birthday">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Facebook:</label>
                        <div class="col-md-8">
                            <input class="form-control" value="{{isset($admin->fb_link) ? $admin->fb_link : ''}}"
                                   type="text" name="fb_link">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Mô tả</label>
                        <div class="col-md-8">
                            <textarea style="width: 100%" name="description">{{ $admin->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input class="btn btn-primary" value="Save Changes" type="submit">
                            <span></span>
                            <input class="btn btn-default" value="Cancel" type="reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.col -->
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <form class="form-horizontal" role="form" method="post" action="{{ url('/admin/profile/password') }}">
                    <div class="modal-body">

                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mật khẩu cũ :</label>
                            <div class="col-lg-8">
                                <input class="form-control" value="" type="password" name="old_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mật khẩu mới :</label>
                            <div class="col-lg-8">
                                <input class="form-control" value="" type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Xác nhận mật khẩu mới :</label>
                            <div class="col-lg-8">
                                <input class="form-control" value="" type="password" name="password_confirmation">
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <label class="col-md-6 control-label"></label>
                            <div class="col-md-6">
                                <input class="btn btn-primary" value="Thay đổi mât khẩu" type="submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @push('scripts')
    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_file").change(function () {
            readURL(this);
        });
    </script>
    @endpush

@endsection