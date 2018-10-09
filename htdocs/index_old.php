<!DOCTYPE html>  
<head>
  <title>UPDATE PostgreSQL data with PHP</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>li {list-style: none;}</style>
</head>
<body>
  <h2>Supply bookid and enter</h2>
  <ul>
    <form name="display" action="index.php" method="POST" >
      <li>Book ID:</li>
      <li><input type="text" name="bookid" /></li>
      <li><input type="submit" name="submit" /></li>
    </form>
  </ul>
  <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db     = pg_connect("host=localhost port=5432 dbname=Project1 user=postgres password=cs2102team09");	
    $result = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid]'");		// Query template
    $row    = pg_fetch_assoc($result);		// To store the result row
    
    $valid_bookid = $_POST[bookid];
    if (pg_num_rows($result) == 0 && !isset($_POST['new'])) {
      echo "No valid row found with bookid as $_POST[bookid]";
    }
    if (isset($_POST['submit']) && pg_num_rows($result) > 0) {
        echo "<h3>Update row details below</h3>
      <ul><form name='update' action='index.php' method='POST' >  
    	<li>Book ID:</li>  
    	<li><input type='text' name='bookid_updated' value='$row[book_id]' /></li>  
    	<li>Book Name:</li>  
      <input type='hidden' name='book_id' value='$row[book_id]'' />
    	<li><input type='text' name='book_name_updated' value='$row[name]' /></li>  
    	<li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>  
    	<li>Date of publication:</li>  
    	<li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>  
    	<li><input type='submit' name='new' /></li>  
    	</form>  
    	</ul>";
    }
    if (isset($_POST['new'])) {	// Submit the update SQL command
        $result = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]',  
    name = '$_POST[book_name_updated]',price = '$_POST[price_updated]',  
    date_of_publication = '$_POST[dop_updated]' WHERE book_id = '$_POST[book_id]' ");
        if (!$result) {
            echo "\n Update failed!!";
        } else {
            echo "\n Update successful!";
        }
    }
    ?>  
</body>
</html>