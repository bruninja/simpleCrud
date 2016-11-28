!<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <!-- html form here where the product information will be entered -->
      <form action='create.php' method='post'>
          <table class='table table-hover table-responsive table-bordered'>
              <tr>
                  <td>Name</td>
                  <td><input type='text' name='name' class='form-control' /></td>
              </tr>
              <tr>
                  <td>Description</td>
                  <td><textarea name='description' class='form-control'></textarea></td>
              </tr>
              <tr>
                  <td>Price</td>
                  <td><input type='text' name='price' class='form-control' /></td>
              </tr>
              <tr>
                  <td></td>
                  <td>
                      <input type='submit' value='Save' class='btn btn-primary' />
                      <a href='read.php' class='btn btn-danger'>Back to read products</a>
                  </td>
              </tr>
          </table>
      </form>

      <?php
      if($_POST){

        // include database connection
        include 'config/database.php';

        try{

          // insert query
          $query = "INSERT INTO products SET name=:name, description=:description, price=:prince, created=:created";

          //prepare query for execution
          $stmt = $con->prepare($query);

          // posted values
          $name=htmlspecialchars(strip_tags($_POST['name']));
          $description=htmlspecialchars(strip_tags($_POST['description']));
          $price=htmlspecialchars(strip_tags($_POST['price']));

          // bind the parameters
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':description', $description);
          $stmt->bindParam(':price', $price);

          // specify when this record was inserted to the database
          $created=date('Y-m-d H:i:S');
          $stmt->bindParam(':created', $created);

          // Execute the query
          if($stmt->execute()){
            echo "<div class='alert alert-success '>Record was saved.</div>";
          }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
          }
        }

        // show error
        catch(PDOException $exception){
          die('ERROR: ' . $exception->getMessage());
        }
      }
      ?>

    </div>

  </body>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>
