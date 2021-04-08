<div class="container-fluid">
	<h3>Add Order Detail</h3>
	<form method="post" action="<?= base_url('index.php/page/form_add_do/' . $id); ?>">
		<table class="table table-striped" id="table_id">
			<thead>
				<tr>
					<th class="text-right" scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Qty Order</th>
					<th scope="col">Qty Sent</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datasets as $data) : ?>
					<tr>
						<th scope="row">
							<div class="form-check text-right">
								<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?= $data->ID; ?>">
							</div>
						</th>
						<td><?= $data->Name; ?></td>
						<td><?= $data->Qty_Order; ?></td>
						<td><?= $data->Qty_Sent; ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="panel-footer">
			<input type="submit" value="Save and go back to list" class="btn btn-success">
			<a href="<?= base_url('index.php/page/detail_do/' . $id); ?>" class="btn btn-warning">Cancel</a>
		</div>
	</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_id').DataTable();
	});
</script>
