<?php

declare(strict_types=1);

namespace App\Model\Admin;

use App\Model\AbstractModel;
use PDO;

class AccoundModel extends AbstractModel
{
    public function register(array $data):void
    {
        $name = $data['name'];
        $email = $data['email'];       
        $password = $data['password'];  
        
        $query = "
        INSERT INTO admins(name, email, password)
        VALUES('$name', '$email', '$password')
        ";
        $this->conn->exec($query);
        header("Location: /projekt-kultura/admin.php");
        exit;
    }

    public function checkEmail(string $email):bool
    {
        $query = "SELECT email FROM admins WHERE email = '$email'";
        $result = $this->conn->query($query);
        return (bool) $result->fetch(PDO::FETCH_COLUMN);
    }

    public function login(array $data):bool
    {
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT password FROM admins WHERE email = '$email'";
        $result = $this->conn->query($query);
        $result = $result->fetch(PDO::FETCH_COLUMN);

        if($result){
            if(password_verify($password, $result)){
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                return true;
            }else{
                header("Location: /projekt-kultura/admin.php/?page=login&error=wrongData");
                exit;
            }
        }
        return false;
    }
}