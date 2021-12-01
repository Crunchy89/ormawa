<?php
$CI = &get_instance();
$CI->load->model('m_auth', 'auth');
$getMenuAkses = $CI->auth->getMenuAkses();
?>

<aside class="main-sidebar sidebar-light-warning elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url('admin/dashboard') ?>" class="brand-link bg-warning">
		<img src="<?= base_url('assets/adminlte') ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">UKM STMIK</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url('assets/adminlte') ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?= ucfirst($auth->username) ?></a>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<?php foreach ($getMenuAkses as $m) : ?>

					<?php if ($m->menu == 'dashboard') : ?>
						<li class="nav-item">
							<a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= $active == 'dashboard' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'role') : ?>
						<li class="nav-item">
							<a href="<?= site_url('admin/role') ?>" class="nav-link <?= $active == 'role' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-user-secret"></i>
								<p>
									Role
								</p>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'user') : ?>
						<li class="nav-item">
							<a href="<?= site_url('admin/user') ?>" class="nav-link <?= $active == 'user' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									User
								</p>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'ukm') : ?>
						<li class="nav-item">
							<a href="<?= site_url('admin/ukm') ?>" class="nav-link <?= $active == 'ukm' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-users"></i>
								<p>
									UKM
								</p>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'pembimbing') : ?>
						<li class="nav-item">
							<a href="<?= site_url('admin/pembimbing') ?>" class="nav-link <?= $active == 'pembimbing' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Pembimbing UKM
								</p>
							</a>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'berita') : ?>
						<li class="nav-item <?= $active == 'berita' ? 'menu-is-opening menu-open' : '' ?>">
							<a href="#" class="nav-link <?= $active == 'berita' ? 'active' : '' ?>">
								<i class="nav-icon far fa-newspaper"></i>
								<p>
									Berita
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/menu') ?>" class="nav-link <?= $sub_active == 'berita' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Berita</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/akses') ?>" class="nav-link <?= $sub_active == 'komentar' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Komentar</p>
									</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'pengaturan') : ?>
						<li class="nav-item <?= $active == 'pengaturan' ? 'menu-is-opening menu-open' : '' ?>">
							<a href="#" class="nav-link <?= $active == 'pengaturan' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Pengaturan
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/menu') ?>" class="nav-link <?= $sub_active == 'menu' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Menu</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/akses') ?>" class="nav-link <?= $sub_active == 'akses' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Akses Menu</p>
									</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>
					<?php if ($m->menu == 'menu_ukm') : ?>
						<li class="nav-item <?= $active == 'menu_ukm' ? 'menu-is-opening menu-open' : '' ?>">
							<a href="#" class="nav-link <?= $active == 'menu_ukm' ? 'active' : '' ?>">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Menu UKM
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="<?= site_url('admin/menu_ukm/pembimbing') ?>" class="nav-link <?= $sub_active == 'pembimbing' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Pembimbing</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/akses') ?>" class="nav-link <?= $sub_active == 'pengurus' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Pengurus</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="<?= site_url('admin/pengaturan/akses') ?>" class="nav-link <?= $sub_active == 'anggota' ? 'active' : '' ?>">
										<i class="far fa-circle nav-icon"></i>
										<p>Anggota</p>
									</a>
								</li>
							</ul>
						</li>
					<?php endif; ?>

				<?php endforeach; ?>
				<li class="nav-item">
					<a href="<?= site_url('/') ?>" class="nav-link">
						<i class="nav-icon fas fa-home"></i>
						<p>
							Home
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('auth/logout') ?>" class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							Logout
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
