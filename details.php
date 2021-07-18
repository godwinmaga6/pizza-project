<?php 

include('config/db_connect.php');

// check GET request id parameter
if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']); //escape malicious entries

    //make sql for making query
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    //get the query result
    $result = mysqli_query($conn, $sql);

    //fetch the result in array format
    //NOTE: Since we're needing only one pizza, we'd fetch only one row as it's based on the id in LINE 10
    $pizza = mysqli_fetch_assoc($result); //fetching one row but placing in form of an array

    mysqli_free_result($result);
    mysqli_close($conn);

    //print to test
    print_r($pizza);

}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?>

<div class="container cemter">
    <?php if() : ?>

    <?php else : ?>
    
    <?php endif ?>
</div>

<?php include('templates/footer.php');?>
</html>