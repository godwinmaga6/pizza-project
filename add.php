<?php 

include('config/db_connect.php');

// THE POST & GET Method
// The GET method is considered unsecure as it renders user input on the url input field
// The POST method is considered secure because it does the opposite of the GET method
// The POST method protects users from cross site scripting

//SET DEFUALT VALUES FOR INPUT FIELD VARIABLE
$email = $title = $ingredients = "";
//CREATE AN ASSOCIATIVE ARRAY VARIABLE TO STORE ERRORS
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

//CHECKS if user is sending data to the server (sends an associative array) OR If empty
if(isset($_POST['submit'])){ 
    // echo htmlspecialchars($_POST['email']); //this email here is a key, the value of the key is what the user typed on the form
    // echo htmlspecialchars($_POST['title']); //the htmlspecialchars() checks for malicious code and converts it to strings
    // echo htmlspecialchars($_POST['ingredients']);

    //SERVER Side form validation
    //check if the form is not empty
        //check email
        if(empty($_POST['email'])){
            // echo 'An email is required <br/>'; //if empty is echo this
            $errors['email'] = 'An email is required'; //if empty is adds error to array instead of echo in LINE 20
        }else {
            // echo htmlspecialchars($_POST['email']); //if not empty, we just echo what is expected in LINE 9
            // USING php built-in form filter to validate the email
            $email = $_POST['email']; //grabing the value from the form and storing it in the variable $email
            // CHECK IF IT'S AN ACTUAL EMAIL using php filter form
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){// THE filter_var() function is built-in to php
                // echo 'email must be a valid email address <br/>';
                $errors['email'] = 'email must be a valid email address'; //assigning the error to the associative array of errors
            }
        }
        //check title
        if(empty($_POST['title'])){
            // echo 'A title is required <br/>'; //if empty is echo this
            $errors['title'] = 'A title is required'; //if empty is adds error to array instead of echo in LINE 34
        }else {
            // echo htmlspecialchars($_POST['title']); //if not empty, we just echo what is expected in LINE 10
            // USING RegEx (Regular Expressions) to validate the (Title). 
            // Cause PHP does to have built-in filter for title etc.
            $title = $_POST['title'];
            // CHECKING IF it actually matches our RegEx using php
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){ //first parameter is matching against the second for validation
                // echo 'Title must be letters and spaces only <br/>';
                $errors['title'] = 'Title must be letters and spaces only'; //assigning the error to the associative array of errors
            }

        }
        //check ingredients
        if(empty($_POST['ingredients'])){
            // echo 'At least one ingredient is required <br/>'; //if empty is echo this
            $errors['ingredients'] = 'At least one ingredient is required'; //if empty is adds error to array instead of echo in LINE 50
        }else {
            // echo htmlspecialchars($_POST['ingredients']); //if not empty, we just echo what is expected in LINE 11
            // USING RegEx (Regular Expressions) to validate the (comma separated list). 
            // Cause PHP does to have built-in filter for ingredients etc.
            $ingredients = $_POST['ingredients'];
            // CHECKING IF it actually matches our RegEx using php
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){ //first parameter is matching against the second for validation
                // echo 'Ingredients must be a comma separated list <br/>';
                $errors['ingredients'] = 'Ingredients must be a comma separated list'; //assigning the error to the associative array of errors
            }
        }

        //FINALLY
        //TO RE-DIRECT USER TO THE HOMEPAGE or SOME OTHER PAGE WE DESIRE UPON VALID FORM SUBMISSION
        //We have to check to see if there are no errors & if there are no errors we then re-direct user
        if(array_filter($errors)){ // array_filter circles through an array and performs callBack functions
            echo 'There are erros in the form'; // ..on each of the function which can be defined in the code block                                 
        } else {                                    //NOTE: if we don't define the callBack function, it still runs through the array
            
            //SAVING DATA TO THE DATABASE
            //USING mysqli_real_escape_string() function which escape any kind of malicious sql characters or any sensitive sql character, and it proctect us from sql injections
            $email = mysqli_real_escape_string($conn, $_POST['email']); //which overides the email variable created at LINE 30
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
            //NOW WE HAVE THE DATA WE WANT TO IMSERT TO OUR DATABASE
            //Now we create the sql string that will do that for us
            $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title', '$email', '$ingredients')";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //if success saved
                // Re-direct user
            header('Location: index.php');
            }else{
                echo 'query error: ' . mysqli_error($conn);
            }

            //RESET DEFUALT VALUES FOR INPUT FIELD VARIABLE
            $email = $title = $ingredients = "";

            
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
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); //persist user inputs on the form field ?>">
        <div class="red-text"><?php echo $errors['email'];?></div>
        <label>Your Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title'];?></div>
        <label>Your Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors['ingredients'];?></div>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include('templates/footer.php');?>   
</html>