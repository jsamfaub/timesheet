<?php
function timesheet_basic_input_form() {
	global $date;
?>
	<div id="inputs">
		<form method="POST" action="index.php">
			<input type="hidden" name="date" value="<?=$date?>">
			<button type="submit" name="clear_all_timesheets" id="clear_all_timesheets">Clear all timesheets</button>
			<div style="display:block">
				<select name="start_hour">
					<?php
						for($i=0;$i<24;$i++){
							echo "<option value=".$i.">$i</option>";
						}
					?>
				</select>:
				<select type="select" name="start_minute">
					<?php
						for($i=0;$i<60;$i++){
							if($i==0||$i%15==0){
								echo "<option value=".$i.">$i</option>";
							}
						}
					?>
		
				</select>
			</div>
			<div style="display:block">
				<select name="end_hour">
					<?php
						for($i=0;$i<24;$i++){
							echo "<option value=".$i.">$i</option>";
						}
					?>
				</select>:
				<select type="select" name="end_minute">
					<?php
						for($i=0;$i<60;$i++){
							if($i==0||$i%15==0){
								echo "<option value=".$i.">$i</option>";
							}
						}
					?>
		
				</select>
			</div>
			<button type="submit" name="create_timesheet" id="create_timesheet">Create timesheet</button>
		</form>
	</div>
<?php
}
?>
