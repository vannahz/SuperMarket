<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">  
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">       
	<META HTTP-EQUIV="Expires" CONTENT="0">
	<script type="text/javascript" src="inventory.js"></script>
	<script src="echarts.min.js"></script>
	<script type="text/javascript" src="jquery.knob.js"></script>
	<script>
	$(document).ready(function () {		
		updateOverallResults();		
	});
	</script>
</head>
<body>	
	
	<div class="container">

		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-heartbeat" style="color:#d4312d;"></i>&emsp;Expiring Goods Notification and Management				
				</div>

				<div class="panel-body ">
					<div class="row">
						<table class='table'>
						<tr>
							<th class="text-center" style="border:none; border-right: 1px solid #ccc;" width="20%">
								Schedule
							</th>
							<th class="text-center" style="border:none; border-right: 1px solid #ccc;" width="20%">
								Alert Time
							</th>
							<th class="text-center" style="border:none; border-right: 1px solid #ccc;"  width="25%">
								Targets
							</th>
							<th class="text-center" style="border:none;"  width="35%">
								Trigger Condition
							</th>
						</tr>
						<tr>
							<td style="border:none; border-right: 1px solid #ccc;" class="text-center">
								<div id="schedule"></div>
							</td>
							<td style="border:none; border-right: 1px solid #ccc;" class="text-center">
								<div id="schedule_time"></div>
							</td>
							<td style="border:none; border-right: 1px solid #ccc;">
								<div id="send_to"></div>
							</td>
							<td style="border:none; ">
								<div id="trigger_condition"></div>
							</td>
						</tr>
					</table>
					
					</div>
					<br/>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
							  <div class="panel-heading" id="expiring_goods_list_update_time">Expiring Goods Message</div>
							  <div class="panel-body" id="expiring_goods_list"></div>
							</div>
						</div>
					</div>
				</div><!-- /.panel-body -->
			</div><!-- /.panel -->
		</div><!-- /.row -->
	</div>
</body>
</html>