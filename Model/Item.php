<?php
namespace Humber\Model;

class Item
{
    public function getCategories($db){
        $query = "SELECT *  FROM category";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getItemsInCat($db, $cat){
        //$query = "SELECT programs.program as program, students.id, students.name,students.email FROM students, programs where programs.id = students.program_id AND program_id = :program";
        $query = "SELECT category.name as category, items.id, items.name, items.price, items.calories
        FROM items inner join category on category.id = items.cat_id 
        WHERE cat_id = :cat";

        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':cat', $cat, \PDO::PARAM_STR);
        $pdostm->execute();
        $items = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $items;
    }

    public function getAllItems($dbcon){
        $sql = "SELECT category.name as category, items.id, items.name, items.price, items.calories
        FROM items inner join category on category.id = items.cat_id";


        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();
        $items = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $items;
    }

    public function getItemById($id, $db){
        $sql = "SELECT category.name as category, items.cat_id,  items.id, items.name, items.price, items.calories
        FROM items inner join category on category.id = items.cat_id AND items.id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function addItem($cat, $name, $price, $calories, $db)
    {
        $sql = "INSERT INTO items (cat_id, name, price, calories) 
              VALUES (:cat, :name, :price, :calories) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':cat', $cat);
        $pst->bindParam(':name', $name);
        $pst->bindParam(':price', $price);
        $pst->bindParam(':calories', $calories);

        $count = $pst->execute();
        return $count;
    }

    public function deleteItem($id, $db){
        $sql = "DELETE FROM items WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateItem($id, $cat, $name, $price, $calories, $db){
        $sql = "Update items
                set cat_id = :cat,
                name = :name,
                price= :price,
                calories = :calories
                WHERE id = :id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':cat', $cat);
        $pst->bindParam(':name', $name);
        $pst->bindParam(':price', $price);
        $pst->bindParam(':calories', $calories);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }
}