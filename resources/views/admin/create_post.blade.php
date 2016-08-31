@extends('layouts.admin')

@section('title','Them')

@push('links')
        <!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
<style>
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

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Tạo bài viết mới
                            <small>Các anh chị tạo bài viết thì viết vào đây nhé</small>
                        </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form>
                            <div class="row">
                                <div class="col-sm-9 col-md-8">

                                    <div class="form-group">
                                        <label for="titlePost">Tiêu đề bài viết</label>
                                        <input type="text" class="form-control" id="titlePost"
                                               placeholder="Enter Tiêu đề">
                                    </div>

                                    <div class="form-group">
                                        <label for="editor1">Nội dung</label>
                                         <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            Chỗ này để hiển thị dữ liệu nhé
                                         </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptionPost">Miêu tả ngắn</label>
                                         <textarea id="descriptionPost" name="editor1" style="width: 100%" cols="80">

                                         </textarea>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-4">
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" style="width: 100%;">
                                            <option selected="selected">Xuất bản</option>
                                            <option>Nháp thôi</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" style="width: 100%;">
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Multiple</label>
                                        <div class="input-group ">
                                            <select class="form-control select2 " multiple="multiple"
                                                    data-placeholder="Chọn Tag" style="width: 100%;">
                                                @if(count($tags) > 0)
                                                    @foreach($tags as $tag )
                                                        <option value="{{ $tag->name }}"> {{$tag->name}}</option>

                                                    @endforeach
                                                @endif

                                            </select>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-info btn-flat btn-sm"
                                                        data-toggle="modal" data-target="#addTag"><i
                                                            class="fa fa-plus"></i> Thêm tag
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ảnh đại diện</label>
                                        <img id="demo_img" class="img-responsive"
                                             src="/img/contact-bg.jpg"
                                             alt="Banner Picture">
                                        <div class="form-group fileUpload">
                                            <input type="file" class="upload" id="image_file" name="banner_image"
                                                   value="upload">
                                            <button class="btn btn-primary" style="width: 100%"><i class="fa fa-edit">Tải
                                                    lên banner</i></button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>

    <div class="modal fade" id="addTag" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="location.reload()" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm Tag</h4>
                </div>
                <div class="modal-body">

                    <div id="errors">

                    </div>
                    <form id="addTag">
                        <div class="input-group input-group-sm">
                            {{csrf_field()}}

                            <input id="tag-name" type="text" class="form-control" name="name">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-plus"></i> Thêm
                              </button>
                            </span>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload()">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @endsection


    @push('scripts')
            <!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $(".select2").select2();
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            var roxyFileman = '/fileman/index.html?integration=ckeditor';
            $(function () {
                CKEDITOR.replace('editor1', {
                    filebrowserBrowseUrl: roxyFileman,
                    filebrowserImageBrowseUrl: roxyFileman + '&type=image',
                    removeDialogTabs: 'link:upload;image:upload'
                });

//                CKEDITOR.replace('descriptionPost');
            });

        });
    </script>
    <script>

        // xem truoc anh
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#demo_img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image_file").change(function () {
            readURL(this);
        });

        $('#addTag').submit(function (e) {
            var form = $('form#addTag');
            console.log(form.serialize());
//            return false;


            $.ajax({
                        'url': 'http://localhost:8000/admin/posts/tag',
                        'method': 'POST',
                        'data': form.serialize()

                    }
            ).done(function (success) {
               $('#tag-name').val('');

                if(success.error)
                {
                    var str = '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h4><i class="icon fa fa-ban"></i> Alert!</h4>'+success.error+'</div>';

                }else{
                    var str = '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> <h4><i class="icon fa fa-success"></i> Alert!</h4>'+success.success+'</div>';
                }
                $('#errors').html(str);

                console.log(success);
            }).fail(function (e) {
                console.log(e);
            });
            e.preventDefault();
        })


    </script>

    @endpush