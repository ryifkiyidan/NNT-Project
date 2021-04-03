<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="<?= base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">

	<title>Print Surat Jalan</title>
	<style>
		.table {
			width: 100%;
			border-color: #2980b9;
		}

		.container-1 {
			display: flex;
		}

		.container-1 div {
			padding: 0px;
			align-items: center;
		}

		.box-1 {
			flex: 1;
		}

		.box-2 {
			flex: 1;
		}

		.box-3 {
			flex: 1;
		}

		.border {
			border-color: #2980b9;
		}
	</style>
</head>

<body>
	<?php
	$do = $deliveryorder;
	?>

	<div class="container-fluid my-3">

		<div class="text-center mb-3">
			<div style="position:fixed; z-index: -1;"><img width=79 height=79 src="<?= base_url('assets/img/nnt_logo.png'); ?>"></div>
			<div style="color: #2980b9">
				<div><span style='font-size:18.0pt;line-height:120%;font-family:"Times New Roman",serif;'>PT. NANANG NUSANTARA TRITAMA</span></div>

				<div class="m-0" style='font-size:small; line-height:120%;font-family:"Arial",sans-serif;'>Jl. Kebon Jeruk 19 No. 100 Jakarta Kota 11160</div>

				<div class="m-0" style='font-size:small; line-height:120%;font-family:"Arial",sans-serif;'>Telp. : (021) 649 9545 Fax. : (021) 649 8622</div>

				<div class="m-0" style='font-size:small; line-height:120%; font-family:"Arial",sans-serif'>NPWP 02.063.192.5-032.000</div>
			</div>
		</div>

		<hr style="border: 1px solid #2980b9; margin: 0.2rem 0 !important;">
		<hr style="border: 1px solid #2980b9; margin: 0 0.5rem !important; margin-bottom: 0.2rem !important; opacity: 0.5 !important;">

		<div class="d-flex">
			<div class="box-1">
				<div><span style="color:#2980b9; font-size: small;">Kepada Yth,</span></div>
				<div style="border-bottom: 1px; text-decoration: none;"><span style="font-size: small"><?= $do->Name ?></span></div>
				<div style="border-bottom: 1px; text-decoration: none;"><span style=" font-size: small">PO. NO. <?= $do->PO_Number ?></span></div>
				<div style="border-bottom: 1px; text-decoration: none; margin-right: 60px;"><span style=" font-size: small">Di <?= $do->Location ?></span></div>
			</div>
			<div class="box-2 d-flex align-self-center flex-column">
				<div style="text-align:center;"><span style="color:#2980b9"><u><span style="font-size:18pt;"><b>SURAT JALAN</b></span></u></span></div>
				<div style="text-align:center; font-size: small;"><span style="color:#2980b9;">No. : </span><span> <?= $do->DO_Number ?></span></div>
			</div>
			<div class="box-3 text-end">
				<div class="text-end" style="margin-left:30px; font-size: small;"><span style="color:#2980b9;">Jakarta<b>,</b></span> <span><?= date('j F Y', strtotime($do->Date)) ?></span></div>
			</div>
		</div>

		<table class="table mt-2">
			<thead>
				<tr style="color: #2980b9;">
					<th class="border border-info text-center" scope="col">No.</th>
					<th class="border border-info text-center" scope="col">Banyaknya</th>
					<th class="border border-info text-center" scope="col">Nama Barang</th>
					<th class="border border-info text-center" scope="col">Keterangan</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($orderdetail as $od) : ?>
					<tr>
						<th class="border-info border-start border-end border-bottom-0 text-center" scope="row"><?= $i++ ?>.</th>
						<td class="border-info border-end border-bottom-0 text-center"><?= $od->Qty_Sent ?> PCS</td>
						<td class="border-info border-end border-bottom-0"><?= $od->Name ?></td>
						<td class="border-info border-end border-bottom-0"></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<th class="border-info border-start border-end border-bottom"></th>
					<td class="border-info border-end border-bottom"></td>
					<td class="border-info border-end border-bottom"></td>
					<td class="border-info border-end border-bottom"></td>
				</tr>
			</tbody>
		</table>

		<div class="d-flex justify-content-between text-center my-5">
			<div style="color:#2980b9; font-size:small;">
				<div>Penerima</div>
				<div>Tanda Tangan / Cap</div>
				<div style="margin-top: 5rem;"><span style="color:#2980b9;">(......................................)</span></div>
			</div>
			<div style="color:#2980b9; font-size:small;">
				<div>Hormat Kami,</div>
				<div style="margin-top: 6rem;"><span style="color:#2980b9">(......................................)</span></div>
			</div>
		</div>

	</div>

	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="<?= base_url('assets/js/bootstrap.bundle.js'); ?>></script>
</body>

</html>
