@extends('layouts.admin')
@section('title',"List User")

@push('links')

        <!-- DataTables -->
<link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@section('content')
    <p>Hien thi danh sach user nhe</p>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Số thứ tự</th>
                    <th>Tên thành viên</th>
                    <th>Quyền(s)</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>


                @foreach($data as $row)
                    <tr>
                        <td>{{  $row->id}}</td>
                        <td>{{
                        $row->name
                        }}
                        </td>

                        <td> Administrator</td>
                        <td><a href="{{url('admin/user/'.$row->id.'/edit') }}">
                                <button class="btn btn-success btn-sm" style="width: 100%">
                                    <i class="fa fa-btn fa-trash"></i>
                                    Sửa
                                </button>
                            </a></td>
                        <td>
                            <form action="{{ url('admin/user/'.$row->id) }}" method="POST">
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
                    <th>Tên thành viên</th>
                    <th>Quyền(s)</th>
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

