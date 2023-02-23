<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
</head>
<body>
    @if(isset($GraphWeightY))
        <button><a href="HeightChart">View Height Graph</a></button>
    @endif

    @if(isset($GraphHeightY))
        <button><a href="ChildChart">View Weight Graph</a></button>
    @endif

    <button><a href="Child">Home Page</a></button>
    <div id="ChartContainer" style="height:600px;">
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
    
<script>

    
        
    <?php if(isset($GraphWeightY)) { ?>
        var GraphWeightY=<?php echo json_encode($GraphWeightY) ?>;
        //console.log(GraphWeightY);
        //console.log(GraphDataX);

        Highcharts.chart("ChartContainer",{
            title:{
                text:"Child Weight Graph"
            },
            subtitle:{
                text:"Source: ChildDev Clinic Data"
            },
            xAxis:{
                title:{
                    text:"Clinic No"
                },
                //data: GraphDataX
            },
            yAxis:{
                title:{
                    text:"Weight (kg)"
                },
               
            },
            
            series:[{
                name:"Child Weight",
                color: "brown",
                data: GraphWeightY
            }],
                 
        });
    <?php } ?>


    <?php if(isset($GraphHeightY)){  ?>

        var GraphHeightY=<?php echo json_encode($GraphHeightY) ?>;
        var GraphPerimeterY=<?php echo json_encode($GraphPerimeterY) ?>;
        //console.log(GraphDataX);
        console.log(GraphHeightY);
        console.log(GraphPerimeterY);
        Highcharts.chart("ChartContainer",{
            title:{
                text:"Child Height Graph",
            },
            subtitle:{
                text:"Source: ChildDev Clinic Data"
            },
            xAxis:{
                title:{
                    text:"Clinic No"
                },
                //data: GraphDataX
            },
            yAxis:{
                title:{
                    text:"Height (cm)"
                },
            },
            series:[{
                name:"Child Height",
                color: "blue",
                data: GraphHeightY
            },
            {
                name:"Child Head Perimeter",
                color: "red",
                data: GraphPerimeterY
            },
            ]
            
        });
    <?php } ?>

</script>

</body>
</html>