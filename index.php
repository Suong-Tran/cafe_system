<?php

use Humber\Model\{Database, Item};

require_once 'Library/form-functions.php';
require_once 'vendor/autoload.php';


$db = Database::getDb();
$item =  new Item();
$categories = $item->getCategories($db);

$category = $_GET['cat'] ?? "";
if(isset($_GET['cat'])){
   $items = $item->getItemsInCat($db, $_GET['cat']);
} else {
    $items =  $item->getAllItems($db);
}

?>

<html lang="en">
<head>
    <title>Cafe Management System</title>
    <meta name="description" content="Car Management System">
    <meta name="keywords" content="Student, College, Admission, Humber">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<p class="h1 text-center">Cafe Management System</p>
<form action="" method="get">
    <div class="form-group">
        <label for="cat">Make:</label>
        <select  name="cat" class="form-control"
                 id="cat" >
            <?php echo  populateDropdown($categories, $category) ?>
        </select>
        <span style="color: red">

            </span>
    </div>
    <input type="submit" class="button btn btn-primary" name="itemincategory" value= "Submit" />
</form>

<div class="m-1">

    <!--    Displaying Data in Table-->
    <table class="table table-bordered tbl">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">Calories</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $i) { ?>
            <tr>
                <th><?= ucfirst($i->id); ?></th>
                <td><?= ucfirst($i->name); ?></td>
                <td><?= ucfirst($i->category); ?></td>
                <td><?= ucfirst($i->price); ?></td>
                <td><?= ucfirst($i->calories); ?></td>
                <td>
                    <form action="./update-item.php" method="post">
                        <input type="hidden" name="id" value="<?= $i->id; ?>"/>
                        <input type="submit" class="button btn btn-primary" name="updateItem" value="Update"/>
                    </form>
                </td>
                <td>
                    <form action="./delete-item.php" method="post">
                        <input type="hidden" name="id" value="<?= $i->id; ?>"/>
                        <input type="submit" class="button btn btn-danger" name="deleteItem" value="Delete"/>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <a href="./add-item.php" id="btn_addItem" class="btn btn-success btn-lg float-right">Add Item</a>

</div>
</body>
</html>