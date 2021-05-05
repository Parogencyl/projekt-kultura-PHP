<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\AbstractModel;
use PDO;

class TeamModel extends AbstractModel
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
}