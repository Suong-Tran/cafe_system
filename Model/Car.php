<?php
namespace Humber\Model;

class Car
{
    public function getMakes($db){
        $query = "SELECT *  FROM makes";
        $pdostm = $db->prepare($query);
        $pdostm->execute();

        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    public function getCarsInMake($db, $make){
        //$query = "SELECT programs.program as program, students.id, students.name,students.email FROM students, programs where programs.id = students.program_id AND program_id = :program";
        $query = "SELECT makes.make as make, cars.id, cars.model, cars.year FROM cars inner join makes on makes.id = cars.make_id WHERE make_id = :make";

        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':make', $make, \PDO::PARAM_STR);
        $pdostm->execute();
        $cars = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $cars;
    }

    public function getAllCars($dbcon){
        $sql = "SELECT makes.make as make, cars.id, cars.model, cars.year FROM cars inner join makes on makes.id = cars.make_id";


        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $cars = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $cars;
    }

    public function getCarById($id, $db){
        $sql = "SELECT makes.make as make, cars.make_id,  cars.id, cars.model,cars.year FROM cars inner join makes on makes.id = cars.make_id AND cars.id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        return $pst->fetch(\PDO::FETCH_OBJ);
    }

    public function addCar($make, $model, $year, $db)
    {
        $sql = "INSERT INTO cars (make_id, model, year) 
              VALUES (:make, :model, :year) ";
        $pst = $db->prepare($sql);

        $pst->bindParam(':make', $make);
        $pst->bindParam(':model', $model);
        $pst->bindParam(':year', $year);

        $count = $pst->execute();
        return $count;
    }

    public function deleteCar($id, $db){
        $sql = "DELETE FROM cars WHERE id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;

    }

    public function updateCar($id, $make, $model, $year, $db){
        $sql = "Update cars
                set make_id = :make,
                model = :model,
                year= :year
                WHERE id = :id
        
        ";

        $pst =  $db->prepare($sql);

        $pst->bindParam(':make', $make);
        $pst->bindParam(':model', $model);
        $pst->bindParam(':year', $year);
        $pst->bindParam(':id', $id);

        $count = $pst->execute();

        return $count;
    }
}