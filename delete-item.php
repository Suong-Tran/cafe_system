<?php
use Humber\Model\{Database, Item};
require_once 'vendor/autoload.php';


if(isset($_POST['id'])){


    $id = $_POST['id'];
    $db = Database::getDb();

    $i = new Item();
    $count = $i->deleteItem($id, $db);


    if($count){
        header("Location: index.php");
    }
    else {
        echo " problem deleting";
    }


}