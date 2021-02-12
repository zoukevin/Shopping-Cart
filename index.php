<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Shopping Cart </title>
</head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  table-layout: fixed
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #dddddd;
}

h1 {
    font-size: 30px;
}
#empty {
    color: white;
    background-color: black;
    width: 100%;
    border: none;
    padding: 14px 28px;
    font-size: 16px;
    cursor: pointer;
}

.button {
    display: inline-block;
    padding: 14px 28px;
    width: 100%;
    cursor: pointer;
}
 
</style>

<body>

<?php
session_start();

//Classes
class Item {
    public $name;
    public $price;

    function set_name($name) {
        $this->name = $name;
    }

    function set_price($price) {
        $this->price = number_format((float)$price, 2, '.', '');
    }

    function get_name() {
        return $this->name;
    }

    function get_price() {
        return $this->price;
    }    
}
// ######## please do not alter the following code ######## 
    $products = [ 
    [ "name" => "Sledgehammer", "price" => 125.75 ], 
    [ "name" => "Axe", "price" => 190.50 ], 
    [ "name" => "Bandsaw", "price" => 562.131 ], 
    [ "name" => "Chisel", "price" => 12.9 ],  
    [ "name" => "Hacksaw", "price" => 18.45 ], 
   ]; 
   // ########################################################
   
//Initialize Items
    $total = 0;
    $sledgehammer  = new Item();
    $sledgehammer->set_name($products[0]["name"]);
    $sledgehammer->set_price($products[0]["price"]);
    $axe = new Item();
    $axe->set_name($products[1]["name"]);
    $axe->set_price($products[1]["price"]);
    $bandsaw  = new Item();
    $bandsaw->set_name($products[2]["name"]);
    $bandsaw->set_price($products[2]["price"]);
    $chisel = new Item();
    $chisel->set_name($products[3]["name"]);
    $chisel->set_price($products[3]["price"]);
    $hacksaw = new Item();
    $hacksaw->set_name($products[4]["name"]);
    $hacksaw->set_price($products[4]["price"]);

//Add to Cart
    if (isset($_POST['add_sledgehammer'])){
        if (isset($_SESSION['Sledgehammer'])) {
            $_SESSION['Sledgehammer'] += 1;          
        } else {
            $_SESSION['Sledgehammer'] = 1;
        }
    }
    if (isset($_POST['add_axe'])){
        if (isset($_SESSION['Axe'])) {
            $_SESSION['Axe'] += 1;          
        } else {
            $_SESSION['Axe'] = 1;
        }
    }
    if (isset($_POST['add_bandsaw'])){
        if (isset($_SESSION['Bandsaw'])) {
            $_SESSION['Bandsaw'] += 1;          
        } else {
            $_SESSION['Bandsaw'] = 1;
        }
    }
    if (isset($_POST['add_chisel'])){
        if (isset($_SESSION['Chisel'])) {
            $_SESSION['Chisel'] += 1;          
        } else {
            $_SESSION['Chisel'] = 1;
        }
    }
    if (isset($_POST['add_hacksaw'])){
        if (isset($_SESSION['Hacksaw'])) {
            $_SESSION['Hacksaw'] += 1;          
        } else {
            $_SESSION['Hacksaw'] = 1;
        }
    }

//Remove from Cart
    if (!empty($_SESSION)){
        if (isset($_POST['remove_sledgehammer'])) {
                $_SESSION['Sledgehammer'] -= 1;          
            }
        if (isset($_POST['remove_axe'])){
                $_SESSION['Axe'] -= 1;          
            }
        if (isset($_POST['remove_bandsaw'])){
                $_SESSION['Bandsaw'] -= 1;          
            }
        if (isset($_POST['remove_chisel'])){
                $_SESSION['Chisel'] -= 1;          
            }
        if (isset($_POST['remove_hacksaw'])){
                $_SESSION['Hacksaw'] -= 1;          
            }
        if (array_sum($_SESSION) == 0) {
            session_unset();
        }
    }

//Empty Cart
    if (isset($_POST['empty_cart'])) {
        session_unset();
    }

?>

<h1>Products</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th></th>
    </tr>
    <tr>
        <td><?php echo $sledgehammer->get_name(); ?></td>
        <td><?php echo "$".$sledgehammer->get_price(); ?></td>
        <td>
            <form action="index.php" method="post">
                <input type="submit" name="add_sledgehammer" class = "button" value="Add to Cart" />
            </form>
        </td>
    </tr>
    <tr>
        <td><?php echo $axe->get_name(); ?></td>
        <td><?php echo "$".$axe->get_price(); ?></td>
        <td>
            <form action="index.php" method="post">
                <input type="submit" name="add_axe" class = "button" value="Add to Cart" />
            </form>
        </td>
    </tr>
    <tr>
        <td><?php echo $bandsaw->get_name(); ?></td>
        <td><?php echo "$".$bandsaw->get_price(); ?></td>
        <td>
            <form action="index.php" method="post">
                <input type="submit" name="add_bandsaw" class = "button" value="Add to Cart" />
            </form>
        </td>
    </tr>
    <tr>
        <td><?php echo $chisel->get_name(); ?></td>
        <td><?php echo "$".$chisel->get_price(); ?></td>
        <td>
            <form action="index.php" method="post">
                <input type="submit" name="add_chisel" class = "button" value="Add to Cart" />
            </form>
        </td>
    </tr>
    <tr>
        <td><?php echo $hacksaw->get_name(); ?></td>
        <td><?php echo "$".$hacksaw->get_price(); ?></td>
        <td>
            <form action="index.php" method="post">
                <input type="submit" name="add_hacksaw" class = "button" value="Add to Cart" />
            </form>
        </td>
    </tr>
</table>
    
<table>
    <?php 
    if (!empty($_SESSION)) {
        echo "<h1>Cart</h1>";
        echo "<tr><th>Name</th><th>Cost</th><th>Quantity</th>";
        echo '<th><form action="index.php" method="post"><input type="submit" name="empty_cart" id = "empty" value="Empty and close the Cart" /></form>';
        echo "</th></tr>";
        foreach ($_SESSION as $key => $value) {
            if ($key == "cart" || $key == "place" || $value == 0) {
                continue;
            } else {
                $temp;    
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td> $";
                if ($key == "Sledgehammer") {
                    $temp = "remove_sledgehammer";  
                    echo $sledgehammer->get_price() * $value;
                    $total += $sledgehammer->get_price() * $value;
                } else if ($key == 'Axe') {
                    $temp = "remove_axe"; 
                    echo $axe->get_price()  * $value;
                    $total += $axe->get_price()  * $value;
                } else if ($key == 'Bandsaw') {
                    $temp = "remove_bandsaw"; 
                    echo $bandsaw->get_price()  * $value;
                    $total += $bandsaw->get_price()  * $value;
                } else if ($key == 'Chisel') {
                    $temp = "remove_chisel"; 
                    echo $chisel->get_price()  * $value;
                    $total += $chisel->get_price()  * $value;
                } else if ($key == 'Hacksaw') {
                    $temp = "remove_hacksaw"; 
                    echo $hacksaw->get_price()  * $value;
                    $total += $hacksaw->get_price()  * $value;
                } else {
                    continue;
                }
                echo "</td>";
                echo "<td>".$value."</td>"; 
                echo '<td><form action="index.php" method="post"><input type="submit" name= ';
                echo $temp;
                echo ' class="button" value="Remove one item"/></form></td></tr></tr>';         
            }
        }
        echo "<tr><td></td><td></td><td><b>Total</b></td><td><b>$".$total."</b></td></tr>";
    }
    ?>
</table>
</body>
<script>
//If window refreshes, replace the state with the pre-refreshed state
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>