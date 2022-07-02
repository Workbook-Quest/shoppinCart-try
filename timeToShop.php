<?php

    include("DBConn.php");

    if(isset($_GET['page']))
    {
        $webPage = array("books","cart");

        if(in_array($_GET['page'], $webPage))
        {
            $_thePage = $_GET['page'];
        }
        else
        {
            $_thePage = "books";
        }
    }
    else
    {
        $_thePage = "books";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Workbook Quest</title>
        <link rel="styleSheet" type="text/css" href="styles.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
    <div class = "bg-image">
    <div class = "nav" id="myNav">
            <ul>                
                <li><a href="workbookQuest.php" >How it works</a></li>
                <li><a href="bookListLoggedIn.php">Book List</a></li>
                <li><a href="contactUsLoggedIn.php">Contact Us</a></li>
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="account.php">Account</a></li>
                <li><a href="logOut.php" style = "color: white;">Log Out</a></li>
                <li><a href="timeToShop.php" class = "active"><img alt src="images/cart.png" style="width: 40px; height: 40px;"></a></li style="background:#ed3228;">
            </ul>
        </div>
        
       <div class="top" style="height: 100px; background-color: transparent"></div>
       <div class="main">
       <h1 style="font-size: 40px; color: white; text-align:left;">Shopping Cart</h1>
       

       <div>

    <?php require($_thePage.".php"); ?>

    </div>

    <div id="sidebar">

    <?php 
        if(isset($_SESSION['cart'])) 
        {
            $arrProductIds=array();
        
            foreach ($_SESSION['cart'] as $id => $value) 
            {
                $arrProductIds[] = $id;
            }
            $strIds=implode(",", $arrProductIds);
        
            $stmt = $connectMyDB->prepare("SELECT * FROM tblbooks WHERE BookId IN (?)");
            $stmt->bind_param("s", $strIds);
            $stmt->execute();
            $result = $stmt->get_result();
        
            while ($row = $result->fetch_assoc()) 
            {
            ?>
                <p><?php echo $row['BookTitle'] ?> x <?php echo $_SESSION['cart'][$row['BookId']]['Stock'] ?></p>
            <?php
            } 
            ?>
                <!--hr /-->
                <!--a href="bookListLoggedIn.php?page=cart">Go to cart</a-->
                <a href="timeToShop.php?page=cart">Go to Cart</a>
            <?php
        } 
        else 
        {
            echo "<p>Your Cart is empty. Please add some books.</p>";
        }
    ?>

    </div>
       </div>
    </body>
</html>