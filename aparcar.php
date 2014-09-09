<?php
    $lat = $_REQUEST['lat'];
    $lng = $_REQUEST['lng'];
    
    include 'conexion.php';
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
    
    $query = "UPDATE posicion SET lat=".$lat.",lng=".$lng." WHERE id=1";
    
    //echo $query;
    
    //Sobreescribimos la posicion.
    mysqli_query($con,$query);
    
    mysqli_close($con);
    
    //header('Location: index.php');
    echo "<script>location.href = 'index.php'</script>";
    
?>