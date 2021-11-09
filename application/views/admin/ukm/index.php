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
						<th>Nama UKM</th>
						<th>Aktif</th>
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
							<label for="nama_ukm">Nama UKM</label>
							<input type="text" id="nama_ukm" name="nama_ukm" placeholder="Masukkan nama UKM" class="form-control">
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
				$('#modal').find('.simpan').html('Tambah')
				$('#modal').find('#aksi').val('tambah')
				$('#modal').modal('show');
			});
		<?php endif; ?>
		<?php if ($role_access->can_edit) : ?>
			$('#data').on('click', '.aktif', function() {
				let data = new FormData();
				data.append('uuid', $(this).data('uuid'));
				axios.post(`<?= site_url('admin/ukm/aktif') ?>`, data)
					.then(res => {
						if (res.data.status)
							toastr.success(res.data.pesan);
						else
							toastr.error(res.data.pesan);
						table.ajax.reload()
					})
					.catch(err => {
						toastr.error("Terjadi kesalahan Silahkan coba lagi");
					})
			})
			$('#data').on('click', '.edit', function() {
				$('.modal-body').html(form);
				$('#modal').find('h5').html('Edit Data')
				$('#modal').find('.simpan').html('Simpan')
				$('#modal').find('#aksi').val('edit')
				$('#modal').find('#uuid').val($(this).data('uuid'))
				$('#modal').find('#nama_ukm').val($(this).data('nama_ukm'))
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
					})
					.catch(err => {
						toastr.error("Terjadi kesalahan Silahkan coba lagi");
					})
			})
		<?php endif; ?>
	})
</script>
