<!doctype html>
    <html>
<head><title>Patient Registration</title>

</head>
<body>
<?php
include "publicheader.php";
?>
<center>
    <h1>DENGUE PATIENT REGISTRATION</h1>
    <br><br>
    <form action="addpatient.php" method="post">
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="nam"></td>
            </tr>
            <tr>
                <td>Father's Name</td>
                <td><input type="text" name="fname"></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><input type="text" name="phone"></td>
            </tr>
            <tr><td></td><td><input type="submit" value="Submit"></td></tr>
        </table>
        <!--<input type="button" onclick="getLocation()" value="Get Positions">-->

        <input type="hidden" id="lat" name="latitude">
        <input type="hidden" id="long" name="longitude">
    </form>
</center>
<script>

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }

    function showPosition(position) {
        var x = document.getElementById("lat");
        var y=document.getElementById("long");
        x.value=position.coords.latitude;
        y.value=position.coords.longitude;
    }
</script>
<?php
include "footer.php";
?>
</body>
</html>