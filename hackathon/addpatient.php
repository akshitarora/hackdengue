<!DOCTYPE html>
<html>
<head>
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <script>
        function initialize() {
            var mapProp = {
                center:new google.maps.LatLng(30,76),
                zoom:5,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            var map=new google.maps.Map(document.getElementById("map"),mapProp);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <script type="text/javascript" src="http://www.heatmapapi.com/Javascript/HeatmapAPIGoogle3.js"></script>
    <script type="text/javascript" src="http://www.heatmapapi.com/Javascript/HeatMapAPI3.aspx?k=43d74245-1e07-451a-bb9e-c05e18d1dea3"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script type="text/javascript">
        var myHeatmap = new GEOHeatmap();
        var myData = null;
        $(function() {
// create data
            myData = new Array();
            for (p = 0; p < 50; p++) {
                var rLatD = Math.floor(Math.random() * 1000);
                var rLonD = Math.floor(Math.random() * 1000);
                var rValD = Math.floor(Math.random() * 10);

                myData.push(38.47 + (rLatD / 15000));
                myData.push(-121.84 + (rLonD / 15000));
                myData.push(rValD);
            }

// configure HeatMapAPI
            myHeatmap.Init(400, 300); // set at pixels for your map
            myHeatmap.SetBoost(0.8);
            myHeatmap.SetDecay(0); // see documentation
            myHeatmap.SetData(myData);
            myHeatmap.SetProxyURL('http://www.yahoo.com/proxy.php');

// set up Google map, pass in the heatmap function
            var myLatlng = new google.maps.LatLng(38.5, 76);
            var myOptions = {
                zoom: 11,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map"), myOptions);
            google.maps.event.addListener(map, 'idle', function(event) {
                myHeatmap.AddOverlay(this, myHeatmap);
            });
        });
    </script>
</head>
<body>
<div id="map" style="width:800px;height:380px;"></div>
<?php
include "connection.php";
$s="insert into patient VALUES (null,'".$_POST["nam"]."','".$_POST["fname"]."',".$_POST["phone"].",".$_POST["latitude"].",".$_POST["longitude"].")";
mysqli_query($conn,$s);
echo "Patient Added";
$q="select latitude,longitude from patient";
$res=mysqli_query($conn,$q);
$a=" ";
while($row=mysqli_fetch_array($res))
{
    $a=$a.$row[0]." ".$row[1];
}
echo $a;
?>
</body>
</html>