@extends('layouts.admin')

@section('title','Thêm Category')

@push('links')
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
  <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Thêm mới category</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <form role="form" action="{{ url('/admin/categories/') }}" method="post" enctype="multipart/form-data">
                  {{csrf_field()}}
                  <div class="box-body">
                      <div class="form-group">
                          <label for="titleCategory">Title</label>
                          <input type="text" class="form-control" id="titleCategory" name="title" placeholder="Enter title">
                      </div>
                      <div class="form-group">
                          <label for="description">Mô tả</label>
                          <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                      </div>
                      <div class="form-group">
                          <label>
                              <input type="checkbox" name="status"> Public or Not
                          </label>

                          <p class="help-block">Có public hay là không?</p>
                      </div>
                      <div class="form-group">
                          <label>Ảnh đại diện</label>
                          <img id="demo_img" class="img-responsive"
                               src="/img/contact-bg.jpg"
                               alt="Banner Picture">
                          <div class="form-group fileUpload">
                              <input type="file" class="upload" id="image_file" name="banner_image"
                                     value="upload">
                              <button class="btn btn-success pull-right" ><i class="fa fa-upload"> Tải
                                      lên banner</i></button>

                          </div>
                      </div>
                  </div>
                  <!-- /.box-body -->

                  <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-lg" style="width: 100%">Tạo mới category</button>
                  </div>
              </form>
          </div>
      </div>
  </div>

@endsection


@push('scripts')

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
</script>

@endpush