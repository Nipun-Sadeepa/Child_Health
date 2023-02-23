<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Charts</title>
</head>
<body>

    button><a href="Child">Home Page</a></button>
    <div id="ChartContainer" style="height:600px;">
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
<script>
	$(document).ready(function(){
	     
	    var data=<?php echo json_encode($data); ?>;    // JS walin php data ganna wdya & php weda krna wedya
        // console.log(data);
        // console.log(data2);

	    var chart = new CanvasJS.Chart("ChartContainer", {
		animationEnabled: true,
		title:{
			text: "Website Traffic"
		},
		axisX:{
			title: "Clinic No",
		},
		axisY: {
			title: "Number of Visitors",	
		},
		data: [{
			type: "line",
			color: "blue",
			dataPoints: data
		}
        
        ]
		});
		chart.render();
	})
</script>

</body>
</html>