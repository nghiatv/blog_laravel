@extends('layouts.admin')
@section('title',"List User")

@push('links')

        <!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@section('content')
    <p>Danh sách các Category</p>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Bảng hiển thị các category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Số thứ tự</th>
                    <th>Tên Category</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>


                @foreach($data as $row)
                    <tr>
                        <td>{{  $row->id }}</td>
                        <td>
                            <a href="{{ url('/admin/categories/'.$row->id) }}">{{$row->name }}</a>
                        </td>

                        <td> {{ $row->description }}</td>
                        <td>
                            @if($row->status == 0)

                                <span class="pull-left-container">
                                        <small class="label pull-right bg-red">Un publish</small>
                                </span>
                            @else
                                <span class="pull-left-container">
                                        <small class="label pull-right bg-green">Publish</small>
                                </span>
                            @endif
                        </td>



                        <td><a href="{{url('admin/categories/'.$row->id.'/edit') }}">
                                <button class="btn btn-success btn-sm" style="width: 100%">
                                    <i class="fa fa-btn fa-trash"></i>
                                    Sửa
                                </button>
                            </a></td>
                        <td>
                            <form action="{{ url('admin/categories/'.$row->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-task-{{ $row->id }}" class="btn btn-danger btn-sm"
                                        style="width: 100%">
                                    <i class="fa fa-btn fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Số thứ tự</th>
                    <th>Tên Category</th>
                    <th>Mô tả</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    @push('scripts')
            <!-- DataTables -->
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        })
    </script>
    @endpush

@endsection

