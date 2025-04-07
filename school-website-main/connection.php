<!-- this is where the connection -->

<?php 

try{

$con = mysqli_connect("localhost", "root", "", "pangbatanggame");

if(!$con){

 die("error connection". mysqli_connect_error());

}

}catch(Exception $e){

    echo $e->getMessage();
    

}

?>