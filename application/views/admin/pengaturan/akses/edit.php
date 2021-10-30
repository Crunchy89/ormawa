<div class="card">
	<div class="card-body">
		<a href="<?= site_url('admin/pengaturan/akses') ?>" class="btn btn-info btn-sm mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
		<form id="form">
			<?php $i = 1;
			foreach ($menu as $row) : ?>
				<?php $cek = $this->db->get_where('akses', ['role_id' => $role_id, 'menu_id' => $row->id])->row();
				if ($cek) :
				?>
					<div class="form-group">
						<input data-role_id="<?= $role_id ?>" class="akses" data-menu_id="<?= $row->id ?>" type="checkbox" name="menu_id[]" id="<?= $i ?>" value="<?= $row->id ?>" checked>
						<label for="<?= $i ?>"><?= $row->menu ?></label>
					</div>
				<?php else : ?>
					<div class="form-group">
						<input data-role_id="<?= $role_id ?>" class="akses" data-menu_id="<?= $row->id ?>" type="checkbox" name="menu_id[]" id="<?= $i ?>" value="<?= $row->id ?>">
						<label for="<?= $i ?>"><?= $row->menu ?></label>
					</div>
				<?php endif; ?>

			<?php $i++;
			endforeach; ?>
		</form>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
	$(document).ready(function() {
		$('#form').on('click', '.akses', function() {
			let data = new FormData();
			data.append('role_id', $(this).data('role_id'));
			data.append('menu_id', $(this).data('menu_id'));
			axios.post(`<?= $link_akses ?>`, data)
				.then(res => {
					if (res.data.status)
						toastr.success(res.data.pesan);
					else
						toastr.error(res.data.pesan);
				})
				.catch(err => {
					toastr.error("Terjadi kesalahan Silahkan coba lagi");
				})
		})
	})
</script>
