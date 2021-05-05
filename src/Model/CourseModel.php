<?php

declare(strict_types=1);

namespace App\Model;

use App\Model\AbstractModel;
use PDO;

class CourseModel extends AbstractModel
{
    public function getCourses():array
    {
        $query = "SELECT * FROM courses ORDER BY id DESC";
        $result = $this->conn->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCourse(string $name):array
    {
        $query = "
        SELECT id, title, price1, price2, price3, variant1, variant2, variant3
        FROM courses 
        WHERE title = '$name'
        ";
        $result = $this->conn->query($query);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function getPrice(string $variant, string $name):float
    {
        $query = "SELECT price$variant as price FROM courses WHERE title = '$name'";
        $result = $this->conn->query($query);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return (float) $result['price'];
    }

    public function generateKey(array $data):void
    {
        $name_of_course = $data['name_of_course'];
        $person = $data['name'] . ' ' . $data['surname'];
        $email = $data['email'];
        $course_variant = $data['variant'];

        $key = uniqid();
        $order = uniqid();

        $query = "
        INSERT INTO `keys` (person, email, course, course_variant, `key`, `order`) 
        VALUES ('$person', '$email', '$name_of_course', '$course_variant', '$key', '$order')
        ";

        if($this->conn->exec($query)){
            header("Location: /projekt-kultura/?page=coursesShop&name=$name_of_course&key=$key");
            exit();
        } else {
            header("Location: /projekt-kultura/?page=paymentFormCourse&error=notCreated");
            exit();
        }
    }

    public function checkKey(array $data):bool
    {
        $name = $data['name'];
        $key = $data['key'];
    
        $query = "SELECT id, created FROM `keys` WHERE `key` = '$key' AND course = '$name' ";
        $result = $this->conn->query($query);
        $result = $result->fetch(PDO::FETCH_ASSOC);

        if($result){
            if(strtotime($result['created']) > strtotime('-10 day')){
                return true;    
            } else {
                return false;    
            }
        }else{
            return false;
        }
    }

}