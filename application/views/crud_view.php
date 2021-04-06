<?php
foreach ($crud['css_files'] as $file) : ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<?php
foreach ($crud['js_files'] as $file) : ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<?php
if (isset($extra) && ($state === 'list' || $state === 'success')) :
?>
	<div class="container mb-5">
		<h3 class="panel-title">Record <?= $table ?></h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<tbody>
					<?php
					$keys = array_keys($extra);
					foreach ($keys as $k) {
					?>
						<tr class="form-field-box" id="<?= $k ?>_field_box">
							<th class="form-display-as-box" style="width:25% !important;" id="<?= $k ?>_display_as_box"> <?= $k ?> </th>
							<td class="form-input-box" id="<?= $k ?>_input_box">
								<div id="field-<?= $k ?>" class="readonly_label"><?= $extra[$k] ?></div>
							</td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
<?php
endif;
?>

<div class="container-fluid mb-5 pb-5">
	<div class="mb-3 text-right">
		<a href="button" class="btn btn-outline-secondary"><i class="fad fa-search-plus"></i> Show All</a>
	</div>

	<?php if ($curr_page === 'activitylog') : ?>
		<h1><?= 'Activity Log'; ?></h1>
	<?php endif; ?>
	<?php echo $crud['output']; ?>
</div>