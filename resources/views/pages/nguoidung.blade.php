@section('title')
	Quản lý Thông tin Người Dùng
@endsection

@extends('layout.index')

@section('content')
<script src="admin_asset/dist/js/extra.js"></script>
<!-- Page Content -->
<div class="container">

	<!-- slider -->
	<div class="row carousel-holder">
		<div class="col-md-2">
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Thông tin tài khoản</h4></div>
				<div class="panel-body">
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
					<form action="nguoidung" method="POST">
						{{ csrf_field() }}
						<div>
							<label>Tên Người Dùng</label>
							<input type="text" class="form-control" name="name" aria-describedby="basic-addon1" 
							@if(isset($taikhoan))
							value="
							
							{{ $taikhoan->name }}
							
								">
							@endif	
						</div>
						<br>
						<div>
							<label>Địa Chỉ Email</label>
							<input type="email" class="form-control" name="email" aria-describedby="basic-addon1" 
							@if(isset($taikhoan))
							value="
							
							{{ $taikhoan->email }}
							" 
							@endif
							readonly
							>
						</div>
						<br>	
						<div class="form-group">
							<p><label>Bạn có muốn thay đổi mật khẩu?</label></p>
							<p>
								<label class="radio-inline">
									<input name="changepassword" id="yes" class="radio-change" value="1"
									type="radio"><span for="yes">Có</span>
								</label>
								<label class="radio-inline">
									<input name="changepassword" id="no" class="radio-change" value="0"
									type="radio" checked=""><span for="no">Không</span>
								</label>
							</p>
							<input class="form-control input-width disabled-field password" type="password" name="password" placeholder="Nhập mật khẩu" disabled="" />
						</div>

						<div class="form-group">
							<p><label>Xác nhận Mật khẩu</label></p>
							<input class="form-control input-width disabled-field password" type="password" name="password_again" placeholder="Nhập lại mật khẩu" disabled="" />
						</div>
						<br>
						<button type="submit" class="btn btn-primary">Thực Hiện
						</button>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-2">
		</div>
	</div>
	<!-- end slide -->
</div>
<!-- end Page Content -->

@endsection

@section('script')

<script >
    $(document).ready(function(){

        $('.radio-change').change(function(){

            if($(this).val() == 1){
            	alert('tesssss');
                $('.password').removeAttr('disabled');
            }
            if($(this).val() == 0){
            	alert('tesssss22');
                 $('.password').attr('disabled','');
            }
           
        })

    });
</script>

@endsection