<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="table" class="table table-stripped w-100" data-url="<?= $url ?>">
				<thead class=" thead-dark">
					<tr>
						<th>No</th>
						<th>Role</th>
						<th>Menu</th>
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
						<input type="hidden" name="id" id="id">
						<div class="form-group">
							<label for="menu">Menu</label>
							<input type="text" id="menu" name="menu" placeholder="Masukkan nama Menu" class="form-control">
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
		<?php if ($role_access->can_edit) : ?>
			$('#data').on('click', '.edit', function() {
				$('.modal-body').html(form);
				$('#modal').find('h5').html('Edit Data')
				$('#modal').find('.simpan').html('Simpan')
				$('#modal').find('#aksi').val('edit')
				$('#modal').find('#id').val($(this).data('id'))
				$('#modal').find('#role').val($(this).data('role'))
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
