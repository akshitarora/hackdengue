<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 80%;
        }
        #floating-panel {
            position: absolute;
            top: 10px;
            left: 25%;
            z-index: 5;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            text-align: center;
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #floating-panel {
            background-color: #fff;
            border: 1px solid #999;
            left: 25%;
            padding: 5px;
            position: absolute;
            top: 10px;
            z-index: 5;
        }
    </style>
</head>

<body>

<div id="floating-panel">
    <button onclick="toggleHeatmap()">Toggle Heatmap</button>
    <button onclick="changeGradient()">Change gradient</button>
    <button onclick="changeRadius()">Change radius</button>
    <button onclick="changeOpacity()">Change opacity</button>
</div>
<div id="map"></div>
<center><form action="test3.php" method="post">
<table>
    <tr><td>Select Age</td><td><select name="age"><option value="">-----</option> <option value="1"><10</option><option value="2">10 to 20</option><option value="3">20 to 30</option><option><30/option></select></td><td><input type="submit" value="View Cases"></td></tr>
</table></form></center>
<?php
include "connection.php";
if(!isset($_POST["age"]))
{

    $s="select latitude,longitude from patient";
}
else
{
    $x=$_POST["age"];
    switch($x)
    {
        case 1:
            $s="select latitude,longitude from patient where age<10";break;
        case 2:
            $s="select latitude,longitude from patient where age BETWEEN 10 and 20";break;
        case 3:
            $s="select latitude,longitude from patient where age BETWEEN 20 and 30";break;
        case 4:
            $s="select latitude,longitude from patient where age>30";break;
    }
}
$result=mysqli_query($conn,$s);
$ar=array();
$ar1=array();
while($row=mysqli_fetch_array($result)) {
//echo $row[0]." ".$row[1]."\n";
    array_push($ar, $row[0]);
    array_push($ar1, $row[1]);
}
?>
<script>

    var map, heatmap;

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 3,
            center: {lat: 35.00, lng: 76.00},
            mapTypeId: google.maps.MapTypeId.MAP
        });

        heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(),
            map: map
        });
    }

    function toggleHeatmap() {
        heatmap.setMap(heatmap.getMap() ? null : map);
    }

    function changeGradient() {
        var gradient = [
            'rgba(0, 255, 255, 0)',
            'rgba(0, 255, 255, 1)',
            'rgba(0, 191, 255, 1)',
            'rgba(0, 127, 255, 1)',
            'rgba(0, 63, 255, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(0, 0, 223, 1)',
            'rgba(0, 0, 191, 1)',
            'rgba(0, 0, 159, 1)',
            'rgba(0, 0, 127, 1)',
            'rgba(63, 0, 91, 1)',
            'rgba(127, 0, 63, 1)',
            'rgba(191, 0, 31, 1)',
            'rgba(255, 0, 0, 1)'
        ]
        heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
    }

    function changeRadius() {
        heatmap.set('radius', heatmap.get('radius') ? null : 20);
    }

    function changeOpacity() {
        heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
    }

    // Heatmap data: 500 Points
    function getPoints() {
        return [
            <?php
            $z="";
            for($e=0;$e<count($ar);$e++)
            $z=$z."new google.maps.LatLng(".$ar[$e].",".$ar1[$e]."),";
            echo $z;
            ?>
            new google.maps.LatLng(37.752986, -122.403112),
            new google.maps.LatLng(37.751266, -122.403355)
        ];
    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfKMPw7gRxyCknTLWAm4mIVVOn0yT3LLc&signed_in=true&libraries=visualization&callback=initMap">
</script>

</body>
</html>