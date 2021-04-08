<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Content Row -->
	<div class="row">

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
								Earnings</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800">Rp<?= number_format($totalEarning->Total, 2, ',', '.'); ?></div>
						</div>
						<div class="col-auto">
							<i class="fad fa-dollar-sign fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
								Total Company</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalCompany; ?></div>
						</div>
						<div class="col-auto">
							<i class="fad fa-building fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Products
							</div>
							<div class="row no-gutters align-items-center">
								<div class="col-auto">
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"> <?= $totalProduct; ?></div>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<i class="fad fa-tshirt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pending Requests Card Example -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								Pending</div>
							<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalPending; ?></div>
						</div>
						<div class="col-auto">
							<i class="fad fa-clock fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Content Row -->

	<div class="row">

		<!-- Area Chart -->
		<div class="col-xl-12 col-lg-7">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-area">
						<canvas id="myAreaChart"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-7 col-lg-6 mb-4">

			<!-- Project Card Example -->
			<div class="card shadow mb-4" style="min-height: 395px;">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Projects</h6>
				</div>
				<div class="card-body">
					<?php
					$i = 0;
					$colorProject = ['bg-danger', 'bg-warning', 'bg-primary', 'bg-info', 'bg-success'];
					?>
					<?php foreach ($project as $key => $value) : ?>
						<h4 class="small font-weight-bold"><?= $value->Label; ?> <span class="float-right"><?= $value->Percentage == 100 ? 'Complete!' : $value->Percentage . '%'; ?></span></h4>
						<div class="progress mb-4">
							<div class="progress-bar <?= $colorProject[$i++]; ?>" role="progressbar" style="width: <?= $value->Percentage ?>%" aria-valuenow="<?= $value->Percentage ?>" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
		<!-- Pie Chart -->
		<div class="col-xl-5 col-lg-5">
			<div class="card shadow mb-4">
				<!-- Card Header - Dropdown -->
				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h6 class="m-0 font-weight-bold text-primary">Fabric Used</h6>
				</div>
				<!-- Card Body -->
				<div class="card-body">
					<div class="chart-pie pt-4 pb-2">
						<canvas id="myPieChart"></canvas>
					</div>
					<div class="mt-4 text-center small">
						<?php
						$i = 0;
						$colorPie = ['text-primary', 'text-info', 'text-success'];
						?>
						<?php foreach ($fabricUsed as $key => $value) : ?>
							<span class="mr-2">
								<i class="fas fa-circle <?= $colorPie[$i++]; ?>"></i> <?= $value->Label ?>
							</span>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Earning Overview - LineChart
	var dataEarning = [];
	var labelEarning = [];
	<?php foreach ($earningOverview as $key => $value) : ?>
		dataEarning.push(<?= $value->Total; ?>);
		labelEarning.push('<?= $value->Label; ?>');
	<?php endforeach; ?>
	var dataLineChart = {
		labels: labelEarning,
		datasets: [{
			label: "Earnings",
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.05)",
			borderColor: "rgba(78, 115, 223, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(78, 115, 223, 1)",
			pointBorderColor: "rgba(78, 115, 223, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			data: dataEarning,
		}],
	};
	// Fabric Used - PieChart
	var dataFabric = [];
	var labelFabric = [];
	<?php foreach ($fabricUsed as $key => $value) : ?>
		dataFabric.push(<?= $value->Total; ?>);
		labelFabric.push('<?= $value->Label; ?>');
	<?php endforeach ?>
	var dataPieChart = {
		labels: labelFabric,
		datasets: [{
			data: dataFabric,
			backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
			hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
			hoverBorderColor: "rgba(234, 236, 244, 1)",
		}],
	};
</script>
