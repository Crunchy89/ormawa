<section class="home-banner-area">
	<div class="container">
		<div class="row justify-content-center fullscreen align-items-center">
			<div class="col-lg-5 col-md-12 d-none d-md-block d-lg-block home-banner-left">
				<img class="img-fluid" src="<?= base_url('assets') ?>/img/login.svg" alt="" />
			</div>
			<div class="col-lg-5 col-md-8 col-sm-12 home-banner-right offset-lg-2">
				<div class="card shadow">
					<div class="card-body">
						<?php if ($this->session->flashdata('error')) { ?>
							<div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
						<?php } ?>
						<h3>Masuk</h3>
						<div class="divider"></div>
						<form action="<?= site_url('auth') ?>" method="post">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" id="username" name="username" value="<?= set_value('username') ?>" placeholder="Masukkan Username" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>">
								<?= form_error('username'), '<div class="invalid-feedback text-red">', '</div>' ?>
							</div>
							<div class="form-group mb-3">
								<label for="password">Password</label>
								<input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>">
								<?= form_error('password'), '<div class="invalid-feedback text-red">', '</div>' ?>
							</div>
							<div class="form-group">
								<button class="btn btn-warning text-light" type="submit">Masuk</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
