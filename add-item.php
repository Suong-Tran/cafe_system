<?php

use Humber\Model\{Database, Item};

require_once 'vendor/autoload.php';
require_once "Library/form-functions.php";

$i = new Item();
$cats = $i->getCategories(Database::getDb());

if (isset($_POST['addItem'])) {
    $name = $_POST['name'];
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $calories = $_POST['calories'];

    $db = Database::getDb();
    $i =  new Item();
    $count = $i->addItem($cat, $name, $price, $calories, $db);

    if ($count) {
        header("Location: index.php");
    } else {
        echo "problem adding a car";
    }
}

?>

<html lang="en">

<head>
    <title>Add New Item - Cafe Management System</title>
    <meta name="description" content="Cafe Management System">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>

<body>

    <div>
        <!--    Form to Add  Student -->
        <form action="" method="post">

            <div class="form-group">
                <label for="cat">Category :</label>
                <select name="cat" class="form-control" id="cat">
                    <?php echo  populateDropdown($cats) ?>
                </select>
                <span style="color: red">

                </span>
            </div>
            <div class="form-group">
                <label for="name">Name :</label>
                <input type="text" class="form-control" id="name" name="name" value="" placeholder="Enter Name">
                <span style="color: red">

                </span>
            </div>
            <div class="form-group">
                <label for="price">Price :</label>
                <input type="text" name="price" value="" class="form-control" id="price" placeholder="Enter Price">
                <span style="color: red">

                </span>
            </div>
            <div class="form-group">
                <label for="calories">Calories :</label>
                <input type="text" name="calories" value="" class="form-control" id="calories" placeholder="Enter Calories">
            </div>
            <div>
                <a href="./index.php" id="btn_back" class="btn btn-success float-left">Back</a>
                <button type="submit" name="addItem" class="btn btn-primary float-right" id="btn-submit">
                    Add Item
                </button>
            </div>

        </form>
    </div>


</body>

</html