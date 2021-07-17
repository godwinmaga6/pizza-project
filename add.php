<?php 


?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?> 

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="" method="" class="white">
        <label>Your Email:</label>
        <input type="text" name="email">
        <label>Your Title:</label>
        <input type="text" name="title">
        <label>Your Ingredients (comma separated):</label>
        <input type="text" name="ingredients">

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php');?>   
</html>