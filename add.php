<?php 
// THE POST & GET Method
// The GET method is considered unsecure as it renders user input on the url input field
// The POST method is considered secure because it does the opposite of the GET method
// The POST method protects users from cross site scripting

//CHECKS if user is sending data to the server (sends an associative array) OR If empty
if(isset($_POST['submit'])){ 
    // echo htmlspecialchars($_POST['email']); //this email here is a key, the value of the key is what the user typed on the form
    echo htmlspecialchars($_POST['title']); //the htmlspecialchars() checks for malicious code and converts it to strings
    echo htmlspecialchars($_POST['ingredients']);

    //SERVER Side form validation
    //check if the form is not empty
        //check email
        if(empty($_POST['email'])){
            echo 'An email is required <br/>'; //if empty is echo this
        }{
            echo htmlspecialchars($_POST['email']); //if not empty, we just echo what is expected in LINE 9
        }
        //check title
        if(empty($_POST['title'])){
            echo 'A title is required <br/>'; //if empty is echo this
        }{
            echo htmlspecialchars($_POST['title']); //if not empty, we just echo what is expected in LINE 9
        }
        //check email
        if(empty($_POST['ingredients'])){
            echo 'At least one ingredient is required <br/>'; //if empty is echo this
        }{
            echo htmlspecialchars($_POST['ingredients']); //if not empty, we just echo what is expected in LINE 9
        }
}; // END OF POST CHECK

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?> 

<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" method="POST" class="white">
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