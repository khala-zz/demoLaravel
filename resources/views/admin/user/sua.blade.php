@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý Người Dùng
                            <small> {{ $user -> name }}</small>
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
                        <form action="admin/user/sua/{{$user -> id}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p><label>Tên Người Dùng</label></p>
                                <input class="form-control input-width" type="text" name="name" placeholder="Nhập tên người dùng" value="{{ $user -> name}}" />
                            </div>

                            <div class="form-group">
                                <p><label>Email</label></p>
                                <input class="form-control input-width" type="email" name="email" placeholder="Nhập địa chỉ Email" 
                                value="{{ $user -> email}}" readonly />
                            </div>

                            <div class="form-group">
                                <p>
                                <input type="checkbox"  name="changePassword" id="changePassword">    
                                <label>Doi Mật khẩu</label></p>
                                <input class="form-control input-width password" type="password" name="password" placeholder="Nhập mật khẩu" disabled="" />
                            </div>

                            <div class="form-group">
                                <p><label>Nhap lai Mật khẩu</label></p>
                                <input class="form-control input-width password" type="password" name="password_again" placeholder="Nhập lại mật khẩu" disabled="" />
                            </div>

                            <div class="form-group">
                                <p><label>Phân Quyền Tài Khoản</label></p>
                                <label class="radio-inline">
                                    <input name="level" value="0" 
                                    @if($user -> level !=1)
                                    	{{"checked"}}
                                    @endif
                                     type="radio">Tài khoản thường
                                </label>
                                <label class="radio-inline">
                                    <input name="level" 
                                     @if($user -> level ==1)
                                    	{{"checked"}}
                                    @endif
                                    value="1" type="radio">Admin
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

@section('script')

<script >
    $(document).ready(function(){

        $('#changePassword').change(function(){
            if($(this).is(':checked')){
                $('.password').removeAttr('disabled');
            }
            else
            {
                $('.password').attr('disabled','');
            }
        })

    });
</script>

@endsection