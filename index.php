<?php 
include('config/db_connect.php');
//NOTE: TO RETRIEVE DATA FROM THE DATABASE
//1st we construct the query, 2nd we make the query 3rd we fetch the result from that query

//**
//1 CONSTRUCT QUERY FOR ALL PIZZAS (NOTE: queries are written in capital letters)
// $sql = 'SELECT * FROM pizzas'; //the SELECT means to select. The * means (all). The FROM (specify the table we want to get data from)

//In cases where you don't want all the data from the table as oppose to the above LINE use:
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

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
// print_r($pizzas);

//SAMPLE CODE FOR CONVERTING STRINGS SEPARATED WITH COMMAS INTO AN ARRAY
// print_r(explode(',', $pizzas[0]['ingredients']));
?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php');?> 

    <h4 class="center grey-text">Pizzas!</h4>
    <div class="container">
        <div class="row">
        <!-- This is where we're gona circle through our pizzas and output them -->
        <!-- changed syntax for looping with the ": & endforeach;" -->
        <?php foreach($pizzas as $pizza) : ?>
            <div class="col s6 m3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']);?></h6>
                        <div>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ingredient) : ?>
                                    <li><?php echo htmlspecialchars($ingredient);?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <!-- LINK UP PIZZA ID TO THE DETAILS PAGE -->
                        <a href="details.php?id=<?php echo $pizza['id'];?>" class="brand-text">more info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- A QUICK GUIDE TO USE ": & endforeach;" SYNTAX -->
        <!-- Uncomment below to test code -->
        <!-- <?php if(count($pizzas) >= 3) : ?>
            <p>there are 3 or more pizzas</p>
        <?php else: ?>
            <p>there are less than 3 pizzas</p>
        <?php endif; ?> -->

        </div>
    </div>

<?php include('templates/footer.php');?>   
</html>