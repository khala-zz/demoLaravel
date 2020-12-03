<nav class="navbar navbar-default navbar-static-top" role='navigation' style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="index.html" class="navbar-brand">
				Admin Area - Khala
			</a>
		</div>
		<!-- navbar-header -->
		<ul class="nav navbar-top-links navbar-right">
			<!-- dropdown -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user fa-fw"></i>
					<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					
					@if(isset($khala))

					<li>
						<i class="fa fa-user fa-fw">{{ $khala -> name }}</i>
				    </li>
				    <li><a href="admin/user/sua/{{ $khala -> id}}">
						<i class="fa fa-gear fa-fw"></i>Setting</a>
				    </li>
				    <li ><a href="admin/logout">
						<i class="fa fa-sign-out fa-fw"></i>Log out</a>
				    </li>
				    @endif
				</ul>
				<!-- /.dropdown user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /..navbar-top-links -->
		@include('admin.layout.menu')
		<!--- navbar-static-side --->
	</nav>