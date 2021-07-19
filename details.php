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
    // print_r($pizza); //commented this LINE

}

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?>

<div class="container center">
    <?php if($pizza) : ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?> </p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']) ?></p>
        
        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value=<?php echo $pizza['id'];?>>
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    <?php else : ?>
        <h5>No such pizza exist</h5>
    <?php endif ?>
</div>

<?php include('templates/footer.php');?>
</html>