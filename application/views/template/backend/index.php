<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php
	$title = match ($curr_page) {
		'activitylog' => 'Activity Log',
		'cusreqsize' => 'Measurement',
		'purchaseorder' => 'Purchase Order',
		'deliveryorder' => 'Delivery Order',
		default => ucfirst($curr_page),
	};
	?>
	<title><?= $title; ?> | PT. Nanang Nusantara Tritama</title>

	<?php if ($curr_page === 'profile' || $curr_page === 'dashboard') : ?>
		<script src="<?= base_url('assets/'); ?>js/jquery.js"></script>
	<?php endif; ?>
	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Favicon -->
	<link rel="shortcut icon" type="image/png" href="<?= base_url('assets/'); ?>img/nnt_logo.png" sizes="16x16" />

	<?php if ($curr_page === 'deliveryorder' && isset($curr_state) && $curr_state === 'add') : ?>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
	<?php endif; ?>

</head>

<body id="page-top">
	<!-- Page Wrapper -->
	<div id="wrapper">
		<?php
		if (isset($sidebarnya)) {
			echo $sidebarnya;
		}
		?>
		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">
			<?php
			echo $topbarnya;
			echo $contentnya;
			?>
		</div>
		<!-- End of Content Wrapper -->
	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Bootstrap core JavaScript-->

	<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

	<?php if ($curr_page === 'dashboard') : ?>
		<!-- Page level plugins -->
		<script src="<?= base_url('assets/'); ?>vendor/chart.js/Chart.min.js"></script>
		<!-- Page level custom scripts -->
		<script src="<?= base_url('assets/'); ?>js/demo/chart-area-demo.js"></script>
		<script src="<?= base_url('assets/'); ?>js/demo/chart-pie-demo.js"></script>
	<?php endif; ?>
	<script src="<?= base_url('assets/'); ?>js/fontawesome.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#nav-<?= $curr_page; ?>").addClass('active');
		});
	</script>
</body>

</html>