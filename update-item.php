<?php

use Humber\Model\{Database, Item};
require_once 'vendor/autoload.php';
require_once "Library/form-functions.php";

$cat = $name = $price = $calories = "";
$i2 = new Item();
$cats = $i2->getCategories(Database::getDb());

//Receiving post request from index.php
if(isset($_POST['updateItem'])){
    $id= $_POST['id'];

    $db = Database::getDb();

    $i = new Item();
    $item = $i->getItemById($id,$db);

    $cat = $item->category;
    $cat_id = $item->cat_id;
    $name = $item->name;
    $price = $item->price;
    $calories = $item->calories;
}

//receiving post request from update-item.php
if(isset($_POST['updItem'])) {
    $cat = $_POST['cat'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $calories = $_POST['calories'];
    $id = $_POST['sid'];

    $db = Database::getDb();
    $i = new Item();
    $count = $i->updateItem($id, $cat, $name, $price,$calories, $db);
    if($count){
        header("Location: index.php");
    } else {
        echo "problem updating an item";
    }
}

?>

<html lang="en">

<head>
    <title>Update Item - Cafe Management System</title>
    <meta name="description" content="Cafe Management System">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css" type="text/css">
</head>

<body>

<div>
    <!--    Form to Update  Student -->
    <form action="" method="post">
        <input type="hidden" name="sid" value="<?= $id; ?>" />
        <div class="form-group">
            <label for="cat">Category:</label>
            <select  name="cat" class="form-control"
                 id="cat" >
                <?php echo  populateDropdown($cats, $cat_id) ?>
            </select>
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="model">Name :</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?= $name; ?>">
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="price">Price :</label>
            <input type="text" name="price" value="<?= $price; ?>" class="form-control"
                   id="price">
            <span style="color: red">

            </span>
        </div>
        <div class="form-group">
            <label for="calories">Calories :</label>
            <input type="text" name="calories" value="<?= $calories; ?>" class="form-control"
                   id="calories">
            <span style="color: red">

            </span>
        </div>
        <a href="./index.php" id="btn_back" class="btn btn-success float-left">Back</a>
        <button type="submit" name="updItem"
                class="btn btn-primary float-right" id="btn-submit">
            Update Item
        </button>
    </form>
</div>


</body>
</html

