<?php
function timesheet_basic_view($date, $total_width, $total_height) { 
	$timesheets=Timesheet::get_timesheets($date); ?>
	<div style="
			width:<?=$total_width?>px;
			height:<?=$total_height?>px;
			display:block;
			position:fixed;
			top:50%;
			left:50%;
			transform: translate(-50%,-50%);
		">
		<div style="
			width:<?=$total_width*1.01?>px;
			height:20px;
			position:relative;
			margin-left:auto;
			margin-right:auto;
		"><span style="display:flex; justify-content:space-between;"><?php
		for($i=0;$i<25;$i++){
			echo "<span>|</span>";
		}
		?></span></div>
	
			<div style="
				border:solid;
				border-radius:15px;
				overflow:hidden;
				width:100%;
				height:100%;
			">
			<?php
				$flag=true;
				foreach($timesheets as $key=>$timesheet){
					$start_time=$timesheet->get_start_time_of_day();
					$end_time=$timesheet->get_end_time_of_day();
					$x=$start_time * $total_width;
					$w=($end_time-$start_time) * $total_width;
					if($flag)$color="blue";
					else $color="red";
					?>
						<div style="
							width:<?=$w?>px;
							height:100%;
							background-color:<?=$color?>;
							display:block;
							position:relative;
							top:<?=-100*$key?>%;
							left:<?=$x?>px;
						"></div>
					<?php
					$flag=!$flag;
				}
			?>
		</div>
	</div>
<?php
}
