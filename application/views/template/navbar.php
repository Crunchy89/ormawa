<nav class="main-header navbar navbar-expand navbar-warning navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">


		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-user"></i>&nbsp; <?= ucfirst($auth->username) ?>
			</a>
			<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<i class="fas fa-user mr-2"></i> Profile
				</a>
				<div class="dropdown-divider"></div>
				<a href="<?= site_url('auth/logout') ?>" class="dropdown-item">
					<i class="fas fa-sign-out-alt mr-2"></i> Logout
				</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
	</ul>
</nav>
