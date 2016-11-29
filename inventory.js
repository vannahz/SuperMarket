// Database
var phpFecthData = function (queryStr, myFunction) {
	if (window.XMLHttpRequest) {
		var xmlhttp = new XMLHttpRequest();
	} else {
		var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var result = JSON.parse(xmlhttp.responseText);
			myFunction(result);
		}
	}
	xmlhttp.open("GET", "inventory_data.php?q=" + queryStr, true);
	xmlhttp.send();
}

// Statistics.html
var updateOverallResults = function () {
	listExpiringGoods();
	getExpiringCondition();
}

// Expiring Goods List
var listExpiringGoods = function (){
	phpFecthData("get_message", function (result) {
		var recordTime = result["recordTime"];
		var goodsList = result["goodsList"];
		
		$("#expiring_goods_list_update_time").html("Expiring Goods List" + "<span class='pull-right'><small>Update Time: " + recordTime + "</small></span>");
			
		if (!goodsList) {
			$("#expiring_goods_list").html("<p class='text-center'>Error. Cannot load expiring goods.</p>");
		} else {
			var len = goodsList.length;
			if (len > 0) {
				var httpStr = "<table class='table table-condensed table-hover'>";
				httpStr += "<tr><th>#</th><th>Product Type</th><th>Product Name</th><th align=right>Expiration Date</th><th align=right>Total Amount</th><th align=right>Left Days</th></tr>";	
				var count = 1;
				for (var goodsEntry in goodsList) {
					httpStr += "<tr><td>"+count+"</td><td>"+goodsList[goodsEntry]["eg_product_type"]+"</td><td>"+goodsList[goodsEntry]["eg_product_name"]+"</td><td align=center>"+goodsList[goodsEntry]["eg_expiration_date"]+"</td><td align=center>"+goodsList[goodsEntry]["eg_amount"]+ "</td><td align=center>"+goodsList[goodsEntry]["eg_leftdays"]+"</td></tr>";
					count++;
				}
				httpStr += "</table>";
				$("#expiring_goods_list").html(httpStr);
			} else {
				$("#expiring_goods_list").html("<p class='text-center'>No Expiring Goods.</p>");
			}
		}
	});
}

var getExpiringCondition = function(){

	phpFecthData("get_trigger_condtion", function(result){

		$("#schedule").html("<h3>"+result["schedule"]+" </h3>");

		$("#schedule_time").html("<h3>"+result["schedule_time"]+" </h3>");

		
		var send_array = result["send_to"].split(';');

		var httpStr = "<table align=center>";
		for(var i=0; i<send_array.length; i++)
			httpStr += "<tr><td align=center>" + send_array[i] + "</td></tr>";
		httpStr += "</table>";
		$("#send_to").html(httpStr);

		var httpStr = "<table class='table table-condensed' width='75%'>";
		httpStr += "<tr><td>Left Percentage: </td><td>"+result["percentage"]+"</td></tr>";
		httpStr += "<tr><td>Left Days: </td><td>"+result["days"]+"</td></tr>";
		httpStr += "</table>";
		
		$("#trigger_condition").html(httpStr);

	});


}

var getNow = function(){
	var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    if(month < 10) month = "0" + month;
    var day = now.getDate();
    if(day < 10) day = "0" + day;
    var hour = now.getHours();
    if(hour < 10) hour = "0" + hour;
	return year + "-" + month + "-" + day + " " + hour + ":00";
}
