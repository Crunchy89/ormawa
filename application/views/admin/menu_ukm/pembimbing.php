<div class="container">
	<div class="row">
		<?php foreach ($ukm as $row) : ?>
			<div class="col-sm-12 col-md-4 col-lg-3">
				<div class="card">
					<div class="card-body">
						<?= $row->nama_ukm ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
