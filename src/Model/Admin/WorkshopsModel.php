<?php

declare(strict_types=1);

namespace App\Model\Admin;

use App\Model\AbstractModel;
use PDO;

class WorkshopsModel extends AbstractModel
{
    public function getWorkshops():array
    {
        $query = "SELECT id, name FROM workshops ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWorkshop(string $name):array
    {
        $query = "SELECT * FROM workshops WHERE name = '$name'";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateWorkshop(array $data):void
    {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];
        $forSale = $data['forSale'];
        $price = $data['price'];

        if($forSale === 'on'){
            $forSale = 1;
        }

        $query = "
            UPDATE workshops 
            SET description = '$description', for_sale = '$forSale', price = '$price'
            WHERE id = '$id'
        "; 

        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'workshops', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageWorkshop&name=$name&success=allUpdated");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageWorkshop&name=$name&error=upload&success=updated");
            exit;
        }else{
            if($this->uploadFile($_FILES, 'workshops', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageWorkshop&name=$name&success=uploaded");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageWorkshop&name=$name&error=update");
            exit;
        }
    }

    public function addWorkshop(array $data):void
    {
        $name = $data['name'];
        $description = $data['description'];
        $forSale = $data['forSale'];
        $price = $data['price'];

        if($forSale === 'on'){
            $forSale = 1;
        }else{
            $forSale = 0;
        }
        
        $query = "INSERT INTO workshops (name, description, for_sale, price)
        VALUES ('$name', '$description', '$forSale', '$price')
        ";
        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'workshops', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=addWorkshop&success=allAdded");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=addWorkshop&error=add&success=added");
            exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=addWorkshop&error=add");
            exit;
        }
    }

    public function deleteWorkshop(int $id, string $name):void
    {
        $query = "DELETE FROM workshops WHERE id = '$id'";
        if($this->conn->exec($query)){
            for($i = 1; $i < 6; $i++){
                if(!unlink("C:/xampp/htdocs/projekt-kultura/public/graphics/workshops/$name".'_'.$i.".png")){
                    break;
                }
            }
            header("Location: /projekt-kultura/admin.php/?page=workshops&success=deleted");
        } else {
            header("Location: /projekt-kultura/admin.php/?page=manageWorkshops&error=delete");
        }
    }

}