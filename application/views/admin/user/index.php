<div class="card">
	<div class="card-body">
		<?php if ($role_access->can_insert) : ?>
			<button type="button" id="tambah" class="btn btn-primary btn-sm mb-3"><i class="fas fa-plus"></i> Tambah Data</button>
		<?php endif; ?>
		<div class="table-responsive">
			<table id="table" class="table table-stripped w-100" data-url="<?= $url ?>">
				<thead class=" thead-dark">
					<tr>
						<th>No</th>
						<th>Username</th>
						<th>Email</th>
						<th>Nama</th>
						<th>Role</th>
						<th>Is Active</th>
						<th>Reset</th>
						<?php if ($role_access->can_delete || $role_access->can_edit) : ?>
							<th>Aksi</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody id="data">

				</tbody>
			</table>
		</div>
	</div>
</div>

<?php if ($role_access->can_delete || $role_access->can_edit || $role_access->can_insert) : ?>
	<!-- modal -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form" data-link="<?= $aksi ?>">
					<div class="modal-body">
						<input type="hidden" name="aksi" id="aksi">
						<input type="hidden" name="uuid" id="uuid">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" id="username" name="username" placeholder="Masukkan nama username" class="form-control">
						</div>
						<div id="add"></div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" id="email" name="email" placeholder="Masukkan nama email" class="form-control">
						</div>
						<div class="form-group">
							<label for="nama">Nama Penguna</label>
							<input type="text" id="nama" name="nama" placeholder="Masukkan nama Penguna" class="form-control">
						</div>
						<div class="form-group">
							<label for="role_id">Role</label>
							<select name="role_id" id="role_id" class="form-control">
								<option value="">Pilih Role</option>
								<?php foreach ($role as $row) : ?>
									<option value="<?= $row->id ?>"><?= $row->role ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary simpan">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
	$(document).ready(function() {
		const form = $('.modal-body').html();
		let url = $('#table').data('url');
		var table = $('#table').DataTable({
			"processing": true,
			"serverSide": true,
			"searching": true,
			"order": [],
			"ajax": {
				"url": url,
				"type": "POST",
			},
			"columnDefs": [{
				"targets": [0],
				"orderable": false
			}]
		});
		<?php if ($role_access->can_insert) : ?>
			$('#tambah').click(() => {
				$('.modal-body').html(form);
				$('#modal').find('h5').html('Tambah Data')
				$('#modal').find('#add').html(`
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control">
				</div>
			`)
				$('#modal').find('.simpan').html('Tambah')
				$('#modal').find('#aksi').val('tambah')
				$('#modal').modal('show');
			});
		<?php endif; ?>
		<?php if ($role_access->can_edit) : ?>
				['is_active'].map(row => {
					$('#data').on('click', `.${row}`, function() {
						let data = new FormData();
						data.append('uuid', $(this).data('uuid'));
						axios.post(`<?= site_url('admin/user') ?>/${row}`, data)
							.then(res => {
								if (res.data.status)
									toastr.success(res.data.pesan);
								else
									toastr.error(res.data.pesan);
								table.ajax.reload()
							})
							.catch(err => {
								toastr.error("Terjadi kesalahan Silahkan coba lagi");
								table.ajax.reload()
							})
					})
				})
		<?php endif; ?>

		<?php if ($role_access->can_edit) : ?>
			$('#data').on('click', '.edit', function() {
				$('.modal-body').html(form);
				$('#modal').find('h5').html('Edit Data')
				$('#modal').find('.simpan').html('Simpan')
				$('#modal').find('#aksi').val('edit')
				$('#modal').find('#uuid').val($(this).data('uuid'))
				$('#modal').find('#username').val($(this).data('username'))
				$('#modal').find('#role_id').val($(this).data('role_id'))
				$('#modal').find('#email').val($(this).data('email'))
				$('#modal').find('#nama').val($(this).data('nama'))
				$('#modal').modal('show');
			})
			$('#data').on('click', '.reset', function() {
				$('.modal-body').html(`
				<input type="hidden" name="uuid" id="uuid" />
				<input type="hidden" name="aksi" id="aksi" />
				<div class="form-group">
					<label for="reset">Password Baru</label>
					<input type="password" name="password" id="password" placeholder="Masukkan Password Baru" class="form-control" />
				</div>
				`);
				$('#modal').find('h5').html('Reset Password')
				$('#modal').find('.simpan').html('Reset')
				$('#modal').find('#aksi').val('reset')
				$('#modal').find('#uuid').val($(this).data('uuid'))
				$('#modal').modal('show');
			})
		<?php endif; ?>
		<?php if ($role_access->can_delete) : ?>
			$('#data').on('click', '.hapus', function() {
				$('.modal-body').html(`
						<input type="hidden" name="aksi" id="aksi" value="hapus">
						<input type="hidden" name="uuid" id="uuid">
						<h3>Apakah Anda Yakin ?</h3>
						`);
				$('#modal').find('h5').html('Hapus Data')
				$('#modal').find('.simpan').html('Hapus')
				$('#modal').find('#aksi').val('hapus')
				$('#modal').find('#uuid').val($(this).data('uuid'))
				$('#modal').modal('show');
			})
		<?php endif; ?>
		<?php if ($role_access->can_delete || $role_access->can_edit || $role_access->can_insert) : ?>
			$('#form').submit(function(e) {
				e.preventDefault();
				let data = new FormData(this);
				let link = $(this).data('link');
				axios.post(link, data)
					.then(res => {
						if (res.data.status)
							toastr.success(res.data.pesan);
						else
							toastr.error(res.data.pesan);
						table.ajax.reload()
						$('#modal').modal('hide')
						console.log(res.data)
					})
					.catch(err => {
						toastr.error("Terjadi kesalahan Silahkan coba lagi");
					})
			})
		<?php endif; ?>
	})
</script>
