<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">

    <title>Đăng Nhập Hệ Thống</title>

    <base href="{{ asset('') }}">
    <!-- bootstrap core css -->
	<link rel="stylesheet" href="admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- metisMenu core css -->
	<link rel="stylesheet" href="admin_asset/bower_components/metisMenu/dist/metisMenu.min.css">

	<!-- custom css -->
	<link rel="stylesheet" href="admin_asset/dist/css/sb-admin-2.css">
	<!-- custom fonts -->
	<link rel="stylesheet" href="admin_asset/bower_components/font-awesome/css/font-awesome.min.css">

	<!-- dataTables css -->
	<link rel="stylesheet" href="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.css">
	<!-- dataTable responsive -->
	<link rel="stylesheet" href="admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css">


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">TRANG ĐĂNG NHẬP</h3>
                    </div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger text-center">
                                @foreach($errors->all() as $err)
                                    <strong>{{ $err }}</strong><br/>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                                <strong>{{ session('thongbao') }}</strong>
                            
                        @endif
                        <form role="form" action="admin/dangnhap" method="POST">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Địa chỉ Email" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Mật Khẩu" name="password" type="password" value="">
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đăng Nhập</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- jquery -->
<script type="text/javascript" src="admin_asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- bootstrap core js -->
<script type="text/javascript" src="admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- metisMenu core css -->
<script type="text/javascript" src="admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- custom theme js -->
<script type="text/javascript" src="admin_asset/dist/js/sb-admin-2.js"></script>

<!-- datatable js -->
<script type="text/javascript" src="admin_asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<!-- ckeditor -->
<script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js" ></script>

@yield('script')

</body>

</html>
