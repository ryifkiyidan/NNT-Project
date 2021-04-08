<div class="container-fluid">
	<form action="">
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Qty Order</th>
					<th scope="col">Qty Sent</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($datasets as $data) : ?>
					<tr>
						<th scope="row">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="<?= $data->ID; ?>">
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
			<input id="form-button-save" type="submit" value="Save" class="btn btn-success">
			<input type="button" value="Save and go back to list" class="btn btn-success" id="save-and-go-back-button">
			<input type="button" value="Cancel" class="btn btn-warning" id="cancel-button">
		</div>
	</form>
</div>
