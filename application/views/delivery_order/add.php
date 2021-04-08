<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h3><span>Record Product to Shipment</span></h3>
		</div>
		<div class="card-body">
			<div class="panel-body">
				<div class="float-left">
					<div id="606ec2bd3fabe_filter" class="dataTables_filter">
						<label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="606ec2bd3fabe"></label>
					</div>
				</div>
				<div class="float-right" style="margin-top: 25px;">
					<a href="http://localhost/nnt-project/index.php/page/purchaseorder/edit/2" class="edit_button btn btn-xs btn-secondary btn-sm hidden-xs mb-1 mr-1" role="button">
						<svg class="svg-inline--fa fa-pencil-alt fa-w-16" aria-hidden="true" focusable="false" data-prefix="far" data-icon="pencil-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
							<path fill="currentColor" d="M491.609 73.625l-53.861-53.839c-26.378-26.379-69.075-26.383-95.46-.001L24.91 335.089.329 484.085c-2.675 16.215 11.368 30.261 27.587 27.587l148.995-24.582 315.326-317.378c26.33-26.331 26.581-68.879-.628-96.087zM200.443 311.557C204.739 315.853 210.37 318 216 318s11.261-2.147 15.557-6.443l119.029-119.03 28.569 28.569L210 391.355V350h-48v-48h-41.356l170.259-169.155 28.569 28.569-119.03 119.029c-8.589 8.592-8.589 22.522.001 31.114zM82.132 458.132l-28.263-28.263 12.14-73.587L84.409 338H126v48h48v41.59l-18.282 18.401-73.586 12.141zm378.985-319.533l-.051.051-.051.051-48.03 48.344-88.03-88.03 48.344-48.03.05-.05.05-.05c9.147-9.146 23.978-9.259 33.236-.001l53.854 53.854c9.878 9.877 9.939 24.549.628 33.861z"></path>
						</svg><!-- <i class="far fa-pencil-alt"></i> Font Awesome fontawesome.com -->
						Edit </a>

					<a onclick="javascript: return delete_row('http://localhost/nnt-project/index.php/page/purchaseorder/delete/2', '1')" href="javascript:void(0)" class="delete_button btn btn-xs btn-danger btn-sm hidden-xs mb-1 mr-1" role="button">
						<svg class="svg-inline--fa fa-trash fa-w-14" aria-hidden="true" focusable="false" data-prefix="far" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
							<path fill="currentColor" d="M432 80h-82.4l-34-56.7A48 48 0 0 0 274.4 0H173.6a48 48 0 0 0-41.2 23.3L98.4 80H16A16 16 0 0 0 0 96v16a16 16 0 0 0 16 16h16l21.2 339a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128h16a16 16 0 0 0 16-16V96a16 16 0 0 0-16-16zM173.6 48h100.8l19.2 32H154.4zm173.3 416H101.11l-21-336h287.8z"></path>
						</svg><!-- <i class="far fa-trash"></i> Font Awesome fontawesome.com -->
					</a>
				</div>
			</div>
			<form action="">
				<table class="table table-striped display" id="table_id">
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
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table_id').DataTable();
	});
</script>