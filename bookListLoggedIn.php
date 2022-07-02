<?php

    include("DBConn.php");

?>

<!DOCTYPE html>
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
                <li><a href="timeToShop.php" style="background:red;"><img alt src="images/cart.png" style="width: 40px; height: 40px;"></a></li>
            </ul>
        </div>
        
       <div class="top" style="height: 100px; background-color: transparent"></div>
       <<div class="main" style="background-color: transparent">
       <h1 style="font-size: 40px; color: white; text-align:left">Book List</h1>
          
        <div class = "textBox" style="color: black; text-align: left; border:none">
            <p for="search" class="formLabel" style = "font-size: 30px; font-weight:bold;">Search</p>
            <input type="text" placeholder="Input Field" name="Search" class="formtext" >
            <button type="submit" name="submit" class="btn" style="height: 50px; width: 80px;"><img alt src="images/search_icon.jpg" style="width: 40px; height: 40px;"></button>
        </div>
        <?php
    session_start();
    if(isset($_SESSION['message'])){
        echo '<div class="alert alert-'.$_SESSION['msg_type'].'">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']);
    }
    
    
    
      
    
?>

    <form action="" method="POST">
        <h1 class="text-info text-center my-5">Book List</h1>
        <table class="table">
            <thead>
                <tr>
                    
                    <th scope="col">BookTitle</th>
                   
                    <th scope="col">BookAuhtor</th>
                    <th scope="col">Quality</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    	
                </tr>
            </thead>
            <?php 
            
                    $sql = "SELECT * FROM tblbooks ORDER BY BookTitle";
                    function function_alert($message) {
      
                        // Display the alert box 
                        echo "<script>alert('$message');</script>";
                    }
                      
                      
                    function_alert("The price is 'Price'");
                    if($connectMyDB === FALSE){
                        echo  "DB Error - " . mysqli_connect_error();
                        exit();
                    }

                    $result = mysqli_query($connectMyDB, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    
                        $BookTitle = $row['BookTitle'];
                        
                        
                        $BookAuthor =$row['BookAuthor'];
                        $Quality=$row['Quality'];
                        $Description=$row['Description'];
                        $Price=$row['Price'];
                        $Stock=$row['Stock'];
                        
                        
                        
                        
                        echo '<tbody>
                                    <tr>
                                    
                                        <td>'.$BookTitle.'</td>
                                        
                                        
                                        <td>'.$BookAuthor.'</td>
                                        <td>'.$Quality.'</td>
                                        <td>'.$Description.'</td>
                                        <td>R'.$Price.'</td>
                                        <td>'.$Stock.'</td>
                                        <td><button type="submit" name="booklistCart" class="btn" onClick="$message"><a href="timeToShop.php"><img alt src=images/cart.png style="width: 40px; height: 40px;" ></a></button></td> 
                                        
                                    </tr>
                                </tbody>';
                    }
                    ?>
                    </table>          
          </form>
        </div>
       </div>

    

       </div>
    </body>
</html>


