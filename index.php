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

//NOTE: TO RETRIEVE DATA FROM THE DATABASE
//1st we construct the query, 2nd we make the query 3rd we fetch the result from that query

//**
//1 CONSTRUCT QUERY FOR ALL PIZZAS (NOTE: queries are written in capital letters)
// $sql = 'SELECT * FROM pizzas'; //the SELECT means to select. The * means (all). The FROM (specify the table we want to get data from)

//In cases where you don't want all the data from the table as oppose to the above LINE use:
$sql = 'SELECT title, ingredients, id FROM pizzas';

//2 MAKE QUERY & GET RESULT
$result = mysqli_query($conn, $sql); //NOTE this result isn't an array & can't be used at this stage

//3 GET ARRAY FROM RESULT
//fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//NEXT FREE RESULT
mysqli_free_result($result);

//NEXT CLOSE CONNECTION TO THE DATABASE
mysqli_close($conn);

//NTOE: Always echo to preview
print_r($pizzas);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?> 


<?php include('templates/footer.php');?>   
</html>