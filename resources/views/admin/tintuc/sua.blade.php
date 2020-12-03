@extends('admin.layout.index')

@section('content')
<script src="admin_asset/dist/js/extra.js"></script>
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small> {{ $tintuc -> TieuDe }} </small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    <strong>{{$err}}</strong><br>
                                @endforeach
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <strong>{{session('error')}}</strong>
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <strong>{{session('thongbao')}}</strong>
                            </div>
                        @endif
                        <form action="admin/tintuc/sua/{{ $tintuc -> id }}" method="POST" enctype="multipart/form-data"> <!-- Form bắt buộc phải có thuộc tính enctype thì mới up được file lên -->
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p><label>Chọn Thể Loại</label></p>
                                <select class="form-control input-width catefield" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $chitietTL)
                                        <option
                                        @if($tintuc -> loaitin -> theloai -> id == $chitietTL -> id)
                                        {{ "selected" }}
                                        @endif

                                         value="{{ $chitietTL->id }}">{{ $chitietTL->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <p><label>Chọn Loại Tin</label></p>
                                <select class="form-control input-width subcatefield" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $chitietLT)
                                        <option 
                                        @if($tintuc -> loaitin -> id == $chitietLT -> id)
                                        {{ "selected" }}
                                        @endif
                                        value="{{ $chitietLT->id }}">{{ $chitietLT->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <p><label>Tiêu Đề</label></p>
                                <input type="text" class="form-control input-width" name="TieuDe" placeholder="Nhập Tiêu Đề Tin Tức" value="{{ $tintuc -> TieuDe }}" />
                            </div>

                            <div class="form-group">
                                <p><label>Tóm Tắt Nội Dung</label></p>
                                <textarea name="TomTat" id="demo" class="form-control ckeditor" rows="3">
                                    {{ $tintuc -> TomTat }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <p><label>Nội Dung Bài Viết</label></p>
                                <textarea name="NoiDung" id="demo" class="form-control ckeditor" rows="5">
                                    {{ $tintuc -> NoiDung }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <p><label>Thêm Hình Ảnh</label></p>
                                <p>
                                <img src="upload/tintuc/{{ $tintuc -> Hinh }}" alt="" width="400px">
                            	</p>
                                <input type="file" class="form-control" name="Hinh">
                            </div>

                            <div class="form-group">
                                <p><label>Tin Tức Nổi Bật?</label></p>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if($tintuc -> NoiBat == 1)
                                    	{{"checked"}}
                                    @endif
                                     type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0"
                                      @if($tintuc -> NoiBat == 0)
                                    	{{"checked"}}
                                    @endif
                                     type="radio">Không
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default btn-mleft">Nhập Lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                <!-- row comment -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Binh Luan
                            <small>> Danh Sách</small>
                        </h1>
                    </div>
                    <div class="clearfix"></div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            <strong>{{session('thongbao')}}</strong>
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th class="text-center">ID</th>
                                <th class="text-center">Người dùng</th>
                                <th class="text-center">Nội dung</th>
                                <th class="text-center">Ngày đăng</th>
                       
                                <th class="text-center">Sửa</th>
                                <th class="text-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc -> comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $cm->id }}</td>
                                <td>
                                    {{ $cm->user->name }}
                                   
                                </td>
                                <td>{{ $cm->NoiDung }}</td>
                                <td>{{ $cm->created_at }}</td>
                              
                              
                             
                                <td class="center">
                                    <i class="fa fa-trash-o  fa-fw"></i>
                                    <a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc -> id }}" >Xóa</a>
                                        
                                     
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- end row comment -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection

@section('script')
<script >
	$(document).ready(function() {
		$("#TheLoai").change(function() {
			var idtheloai = $(this).val();
			$.get('admin/ajax/loaitin/'+ idtheloai, function(data){

				$('#LoaiTin').html(data);

			});
		});
	});
</script>

@endsection