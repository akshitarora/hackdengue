<?php
$con = mysqli_connect('localhost','root','','test') or die("connection failed");
   // mysql_select_db('test',$con) or die("db selection failed");

    $id=$_REQUEST['roll'];
    $name=$_REQUEST['name'];


  //  $flag['code']=0;

    //if(
        $r="INSERT INTO info VALUES('$id','$name')";
        mysqli_query($con,$r);
                        //,$con);
            //)
   // {
      //  $flag['code']=1;
    //    echo"hi";
    //}
        
    //print(json_encode($flag));
    mysqli_close($con);
?>