<div class="container">

	<?php
	if ($this->session->tempdata('message')) { // Jika ada
		echo '<div class="alert alert-success">' . $this->session->tempdata('message') . '</div>'; // Tampilkan pesannya
	}
	if ($this->session->tempdata('error')) { // Jika ada
		echo '<div class="alert alert-danger">' . $this->session->tempdata('error') . '</div>'; // Tampilkan pesannya
	}
	?>
	<h1 class="text-center py-5"><i class="fad fa-id-card"></i> <?= strtoupper($curr_page); ?></h1>
	<div class="row">
		<div class="col-sm-4 text-center mb-5">
			<!-- <h3>Profile</h3> -->
			<img class="rounded-circle" src="<?= base_url('assets/'); ?>img/undraw_profile.svg" width="200">
			<div class="pt-5">
				<h3><?= $user->first_name . " " . $user->last_name; ?></h3>
				<span class="badge badge-success"><?= $user->role; ?></span>
			</div>

		</div>
		<div class="col-sm-8">

			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#profile">About Me</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#account">Account</a>
				</li>
			</ul>

			<div class="tab-content py-3">
				<div class="tab-pane container active" id="profile">
					<form method="post" action="<?= base_url('index.php/page/form_profile'); ?>">

						<!-- Name -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="iFName">First Name</label>
									<input name="iFName" type="text" class="form-control input-box" value="<?= $user->first_name; ?>" placeholder="<?= $user->first_name; ?>" required>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="iLName">Last Name</label>
									<input name="iLName" type="text" class="form-control input-box" value="<?= $user->last_name; ?>" placeholder="<?= $user->last_name; ?>" required>
								</div>
							</div>
							<!-- Gender -->
							<div class="col-sm-12">
								<div class="form-group">
									<label for="iGender">Gender</label>
									<select name="iGender" class="form-control" required>
										<option value="1" <?= ($user->gender == 'Male' ? "selected" : ""); ?>>Male</option>
										<option value="2" <?= ($user->gender == 'Female' ? "selected" : ""); ?>>Female</option>
									</select>
								</div>
							</div>
						</div>

						<button class="btn btn-primary btn-block" type="submit">Save Changes</button>

					</form>
				</div>
				<div class="tab-pane container fade" id="account">
					<form method="post" action="<?= base_url('index.php/page/form_account'); ?>">

						<!-- Username -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control input-box" value="<?= $user->username; ?>" placeholder="<?= $user->username; ?>" name="username" required disabled>
								</div>
							</div>
						</div>

						<!-- Current Password -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="curr_password">Current Password</label>
									<input type="password" class="form-control input-box form-password" placeholder="Current Password" name="curr_password" required>
								</div>
							</div>
						</div>

						<!-- New Password -->
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="new_password">New Password</label>
									<input type="password" class="form-control input-box form-password" placeholder="New Password" name="new_password" required>
								</div>
							</div>
						</div>
						<div class="py-3">
							<input type="checkbox" class="form-checkbox"> Show Password
						</div>
						<button class="btn btn-primary btn-block" type="submit">Save Changes</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.form-checkbox').click(function() {
			if ($(this).is(':checked')) {
				$('.form-password').attr('type', 'text');
			} else {
				$('.form-password').attr('type', 'password');
			}
		});
	});
</script>