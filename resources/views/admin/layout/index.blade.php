<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Trang Quản Trị dành cho trang web của tôi">
    <meta name="author" content="">
    <title>Trang Quản Trị</title>

    <!-- Define default CSS path (you will run into CSS error without this) -->
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
<div id="wrapper">
	<!-- Navigation -->
	@include('admin.layout.header')
	<!--page content -->
	@yield('content')
	<!--#page-wrapper -->
</div>
<!-- /#wrapper -->

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