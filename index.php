<?php 

//conect to database
//NOTE: we can connect using MySQLi or PDO
//PDO stands for PHP Data Object (You learn this when you become better with MySQLi)
$conn = mysqli_connect('localhost', 'maga', 'test1234', 'yommi_pizza');

//connection
if(!$conn){
    echo 'connection error!' . mysqli_connect_error(); //mysqli_connect_error() lets us know what exactly is wrong with our connection
}else{
    echo 'connected';
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?> 


<?php include('templates/footer.php');?>   
</html>