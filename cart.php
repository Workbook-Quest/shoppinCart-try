<!--?php

    include("DBConn.php");

    session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?-->

<!--DOCTYPE html>
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
                <li><a href="cart.php" class = "active"><img alt src="images/cart.png" style="width: 40px; height: 40px;"></a></li-<!- style="background:#ed3228;"-->
            <!--/ul>
        </div>
        
       <div class="top" style="height: 100px; background-color: transparent"></div>
       <div class="main">
       <h1 style="font-size: 40px; color: white; text-align:left;">Shopping Cart</h1>
       <div class="cart"-->
<!--?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
<tbody>
<tr>
<td></td>
<td>ITEM NAME</td>
<td>QUANTITY</td>
<td>UNIT PRICE</td>
<td>ITEMS TOTAL</td>
</tr-->	
<!--?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td-->
<!--img src='<!-?php echo $product["image"]; ?>' width="50" height="40" />
</td>
<td><!-?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<!-?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<!-?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <!-?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <!-?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <!-?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <!-?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <!-?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><!-?php echo "$".$product["price"]; ?></td>
<td><!-?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr-->
<!--?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>
<tr>
<td colspan="5" >
<strong>TOTAL: <!-?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <!-?php
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<!-?php echo $status; ?>
</div>
       </div>
    </body>
</html-->

<?php 
if (isset($_POST['submit'])) {
    foreach($_POST['Stock'] as $key => $val) {
        if($val==0) {
            unset($_SESSION['cart'][$key]);
        }else{
            $_SESSION['cart'][$key]['Stock']=$val;
        }
    }
}
?> 
   
<h1>View cart</h1> 
<a href="timeToShop.php?page=books">Go back to the products page.</a>
<form method="post" action="timeToShop.php?page=cart">
    <table>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Items Price</th>
        </tr>
        <?php 
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
 
            $totalprice=0; 
            while ($row = $result->fetch_assoc()) {
                $subtotal=$_SESSION['cart'][$row['BookId']]['Stock']*$row['Price']; 
                $totalprice+=$subtotal; 
            ?>
                <tr> 
                    <td><?php echo $row['BookTitle'] ?></td> 
                    <td><input type="text" name="Stock[<?php echo $row['BookId'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['BookId']]['Stock'] ?>" /></td> 
                    <td>R<?php echo $row['Price'] ?></td> 
                    <td>R<?php echo $_SESSION['cart'][$row['BookId']]['Stock']*$row['Price'] ?></td> 
                </tr> 
            <?php 
            }
        ?> 
        <tr> 
            <td colspan="4">Total Price: <?php echo $totalprice ?></td> 
        </tr> 
    </table> 
    <br /> 
    <button type="submit" name="submit">Update Cart</button> 
</form> 
<br /> 
<p>To remove an item set its quantity to 0. </p>



