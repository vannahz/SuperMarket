<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mess Wrecker @ Worksap</title>
	<script type="text/javascript" src="jquery-ui/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/moment.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap-datetimepicker.js"></script>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="bootstrap/css/sb-admin.css">
    <link rel="stylesheet" href="bootstrap/font-awesome/css/font-awesome.css">	
	
	<style>
		body { padding-top: 10px; }
	</style>
	<script>
		$(document).ready(function(){
			$('.dropdown-toggle').dropdown();
			var hash = window.location.hash;
			if (hash) {
				var targetStr = hash.substring(1);
				becomeActive($("#navButton_"+targetStr));
				openPage(targetStr+".php","html");
			} else {
				openPage("inventory.php","html");
			}
		});
	</script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">
			Mess Wrecker @ Vannahz
		  </a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav">
			<p class="navbar-text">|</p>
			<li class="navIcon" id="navButton_overall"><a href="#">Overall</a></li>
			<p class="navbar-text">|</p>
			<li class="navIcon active" id="navButton_inventory"><a href="#">Inventory</a></li>
			<p class="navbar-text">|</p>
			<li class="navIcon" id="navButton_finance"><a href="#">Finance</a></li>
			<p class="navbar-text">|</p>
			<li class="navIcon" id="navButton_Sales"><a href="#">Sales</a></li>
			<p class="navbar-text">|</p>
			<li class="navIcon" id="navButton_Purchases"><a href="#">Purchases</a></li>
			<p class="navbar-text">|</p>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			
		  </ul>
		  </div>
	  </div>
	</nav>
	
	<div class="container" id="page-wrapper">	
		
	</div>
	
	<script>			
		var becomeActive = function($element){
			// Make NavBar item active e.g. becomeActive($("#left_side_overview"));
			$(".navIcon").removeClass("active");	
			$element.addClass("active");
		};
		var openPage = function(pageName,pageType){
			// Open target page e.g. openPage("overview.php","html");
			$.ajax({
			url: pageName,
			cache: false,
			dataType: pageType,
			success: function(data) {
				$("#page-wrapper").html(data);
				window.location.hash = pageName.substring(0, pageName.length-4);
			}
			});
		};
		$("#navButton_overall").on("click", function(){
			becomeActive($("#navButton_overall"));
			openPage("overall.php","html")
		});
		$("#navButton_inventory").on("click", function(){
			becomeActive($("#navButton_inventory"));
			openPage("inventory.php","html")
		});
	</script>
</body>
</html>

