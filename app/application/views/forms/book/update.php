<form id="frm">
	<input type="hidden" name="idnya" value="<?=$idnya?>">
	<div class="form-group">
		<label class="form-label" style="width: 30%; display: inline;">Title</label>
		<label class="form-label" style="width: 5%; display: inline;">:</label>
		<input type="text" name="title" value="<?=$title?>" class="form-control" style="width: 65%; display: inline;">
	</div>
	<div class="form-group">
		<label class="" style="width: 30%; display: inline;">Author Name</label>
		<label class="" style="width: 5%; display: inline;">:</label>
		<select name="author_id-alt:Author Name" class="form-control" style="width: 65%; display: inline;">
			<option value="">- pilih -</option>
			<?php
				foreach ($author_list as $author) {
					$sel = "";
					if ($author['author_id'] == $author_id) $sel = "selected";
					echo "<option value='$author[author_id]' $sel>$author[name]</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
		<label class="" style="width: 30%; display: inline;">Date Published</label>
		<label class="" style="width: 5%; display: inline;">:</label>
		<input type="date" name="date_published" value="<?=date('Y-m-d', strtotime($date_published))?>" class="form-control" style="width: 65%; display: inline;">
	</div>
	<div class="form-group">
		<label class="" style="width: 30%; display: inline;">Type</label>
		<label class="" style="width: 5%; display: inline;">:</label>
		<select name="type_id-alt:Type" class="form-control" style="width: 65%; display: inline;">
			<option value="">- pilih -</option>
			<?php
				foreach ($type_list as $type) {
					$sel = "";
					if ($type['type_id'] == $type_id) $sel = "selected";
					echo "<option value='$type[type_id]' $sel>$type[name]</option>";
				}
			?>
		</select>
	</div>
</form>