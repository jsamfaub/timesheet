<?php
function date_selector_input(){
	global $date, $_SERVER;
?>
	<form action="<?=$_SERVER["REQUEST_URI"]?>" method="GET">
		<button type="submit" name="date" value="<?=date("Y-m-d", strtotime($date." -1 days"))?>">Prev</button>
		<span><?=$date?></span>
		<button type="submit" name="date" value="<?=date("Y-m-d", strtotime($date." +1 days"))?>">Next</button>
	</form>
<?php
}
