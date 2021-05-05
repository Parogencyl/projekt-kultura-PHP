<?php

declare(strict_types=1);

namespace App\Model\Admin;

use App\Model\AbstractModel;
use PDO;

class TeamsModel extends AbstractModel
{
    public function getTeams():array
    {
        $query = "SELECT id, name FROM teams ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeam(string $name):array
    {
        $query = "SELECT * FROM teams WHERE name = '$name'";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTeam(array $data):void
    {
        $id = $data['id'];
        $name = $data['name'];
        $description = $data['description'];

        $query = "
            UPDATE teams 
            SET description = '$description'
            WHERE id = '$id'
        "; 

        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'teams', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageTeam&name=$name&success=allUpdated");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageTeam&name=$name&error=upload&success=updated");
            exit;
        }else{
            if($this->uploadFile($_FILES, 'teams', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=manageTeam&name=$name&success=uploaded");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=manageTeam&name=$name&error=update");
            exit;
        }
    }

    public function addTeam(array $data):void
    {
        $name = $data['name'];
        $description = $data['description'];

        $query = "INSERT INTO teams (name, description)
        VALUES ('$name', '$description')
        ";
        if($this->conn->exec($query)){
            if($this->uploadFile($_FILES, 'teams', $name, true)){
                header("Location: /projekt-kultura/admin.php/?page=addTeam&success=allAdded");
                exit;
            }
            header("Location: /projekt-kultura/admin.php/?page=addTeam&error=add&success=added");
            exit;
        } else {
            header("Location: /projekt-kultura/admin.php/?page=addTeam&error=add");
            exit;
        }
    }

    public function deleteTeam(int $id, string $name):void
    {
        $query = "DELETE FROM teams WHERE id = '$id'";
        if($this->conn->exec($query)){
            for($i = 1; $i < 6; $i++){
                if(!unlink("C:/xampp/htdocs/projekt-kultura/public/graphics/teams/$name".'_'.$i.".png")){
                    break;
                }
            }
            header("Location: /projekt-kultura/admin.php/?page=teams&success=deleted");
        } else {
            header("Location: /projekt-kultura/admin.php/?page=manageTeams&error=delete");
        }
    }
}