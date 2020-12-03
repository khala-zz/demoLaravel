@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý Người Dùng
                            <small>> Thêm Người Dùng</small>
                        </h1>
                    </div>
                    
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    <strong>{{ $err }}</strong><br/>                          
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <strong>{{ session('thongbao') }}</strong>
                            </div>
                        @endif
                        <form action="admin/user/them" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p><label>Tên Người Dùng</label></p>
                                <input class="form-control input-width" type="text" name="name" placeholder="Nhập tên người dùng"  />
                            </div>

                            <div class="form-group">
                                <p><label>Email</label></p>
                                <input class="form-control input-width" type="email" name="email" placeholder="Nhập địa chỉ Email" />
                            </div>

                            <div class="form-group">
                                <p><label>Mật khẩu</label></p>
                                <input class="form-control input-width" type="password" name="password" placeholder="Nhập mật khẩu" />
                            </div>

                            <div class="form-group">
                                <p><label>Xác nhận Mật khẩu</label></p>
                                <input class="form-control input-width" type="password" name="password_again" placeholder="Nhập lại mật khẩu" />
                            </div>

                            <div class="form-group">
                                <p><label>Phân Quyền Tài Khoản</label></p>
                                <label class="radio-inline">
                                    <input name="level" value="0" checked="" type="radio">Tài khoản thường
                                </label>
                                <label class="radio-inline">
                                    <input name="level" value="1" type="radio">Admin
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Thực Hiện</button>
                            <button type="reset" class="btn btn-default btn-mleft">Nhập Lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection