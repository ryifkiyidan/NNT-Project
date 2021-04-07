<?php
foreach ($crud['css_files'] as $file) : ?>
	<link type="text/css" rel="stylesheet" href="<?= $file; ?>" />
<?php endforeach; ?>

<?php
foreach ($crud['js_files'] as $file) : ?>
	<script src="<?= $file; ?>"></script>
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
	<?php if ($curr_page === 'cusreqsize') : ?>
		<?php if ($state === 'list') : ?>
			<div class="mb-3 text-right">
				<a href="?opt=<?= $opt === null || $opt !== 'show_less' ? 'show_less' : 'show_all'; ?>" class="btn btn-outline-primary">
					<i class="fad fa-search-<?= $opt === null || $opt !== 'show_less' ? 'minus' : 'plus'; ?>"></i>
					<?= $opt === null || $opt !== 'show_less' ? 'Show Less' : 'Show All'; ?>
				</a>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($curr_page === 'activitylog') : ?>
		<h1><?= 'Activity Log'; ?></h1>
	<?php endif; ?>
	<?= $crud['output']; ?>
</div>
