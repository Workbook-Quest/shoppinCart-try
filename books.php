<?php 


if(isset($_GET['action']) && $_GET['action']=="add") 
{
    $id=intval($_GET['id']);
 
    if(isset($_SESSION['cart'][$id])) 
    {
        $_SESSION['cart'][$id]['Stock']++;
    } 
    else 
    { 
        $stmt = $connectMyDB->prepare("SELECT * FROM tblbooks WHERE BookId = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
 
        if(isset($result['BookId']) && $result['BookId']) 
        {
            $_SESSION['cart'][$result['BookId']] = array(
                "Stock" => 1,
                "Price" => $result['Price']
            );
        } 
        else 
        {
            $message="This book id is invalid!";
        }
    } 
} 
   
?> 

<!--DOCTYPE html>
<html>
    <head>
        <title>Workbook Quest</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
    <div class = "bg-image">
    <div class = "nav" id="myNav">
            <ul>                
            <li><a href="workbookQuest.php" >How it works</a></li>
                <li><a href="bookListLoggedIn.php" class = "active">Book List</a></li>
                <li><a href="contactUsLoggedIn.php">Contact Us</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logOut.php" style = "color: white;">Log Out</a></li>
                <li><a href="cart.php" style="background:red;"><img alt src="images/cart.png" style="width: 40px; height: 40px;"></a></li>
            </ul>
        </div>
        
       <div class="top" style="height: 100px; background-color: transparent"></div>
       <div class="main" style="background-color: transparent">
       <h1 style="font-size: 40px; color: white; text-align:left">Book List</h1>
          
        <div class = "textBox" style="color: black; text-align: left; border:none">
            <p for="search" class="formLabel" style = "font-size: 30px; font-weight:bold;">Search</p>
            <input type="text" placeholder="Input Field" name="Search" class="formtext" >
            <button type="submit" name="submit" class="btn" style="height: 50px; width: 80px;"><img alt src="images/search_icon.jpg" style="width: 40px; height: 40px;"></button>
        </div-->

            <?php 
                if(isset($message)) 
                { 
                    echo "<h2>$message</h2>";
                }
            ?> 
            <table> 
                <tr> 
                    <th>Name</th> 
                    <th>Description</th> 
                    <th>Price</th> 
                    <th>Action</th> 
                </tr> 
                <?php
                   $sql = "SELECT * FROM tblbooks ORDER BY BookTitle";

                   $result = mysqli_query($connectMyDB, $sql);

                   while($row = mysqli_fetch_assoc($result))
                    {
                ?>
                        <tr> 
                            <td><?php echo $row['BookTitle'] ?></td> 
                            <td><?php echo $row['Description'] ?></td> 
                            <td>R <?php echo $row['Price'] ?></td> 
                            <td><a href="timeToShop.php?page=books&action=add&id=<?php echo $row['BookId'] ?>">Add to cart</a></td> 
                        </tr>
                <?php
                    } 
                ?> 
            </table>

        </body>
</html>
