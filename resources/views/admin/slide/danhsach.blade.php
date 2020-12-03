@extends('admin.layout.index')

@section('content')
<script src="admin_asset/dist/js/extra.js"></script>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý Slider
                            <small>> Danh Sách</small>
                        </h1>
                    </div>
                    <div class="clearfix"></div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            <strong>{{ session('thongbao') }}</strong>
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên Slide</th>
                                <th class="text-center">Nội Dung Slide</th>
                                <th class="text-center">Hình</th>
                                <th class="text-center">Link</th>
                                <th class="text-center">Sửa</th>
                                <th class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $chitiet)
                                <tr class="odd gradeX" align="center">
                                    <td>{{ $chitiet->id }}</td>
                                    <td>{{ $chitiet->Ten }}</td>
                                    <td>{{ $chitiet->NoiDung }}</td>
                                    <td>
                                        <img width="500px" src="upload/slide/{{ $chitiet->Hinh }}">
                                    </td>
                                    <td>{{ $chitiet->link }}</td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{ $chitiet->id }}">Sửa</a></td>
                                    <td class="center">
                                        <i class="fa fa-trash-o  fa-fw"></i>
                                      
                                        <a href="admin/slide/xoa/{{ $chitiet->id }}" >Xóa</a>
                                        
                                     
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection