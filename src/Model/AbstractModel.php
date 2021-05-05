<?php

declare(strict_types=1);

namespace App\Model;

use Exception;
use PDO;
use PDOException;

abstract class AbstractModel 
{
    protected PDO $conn;

    public function __construct(array $config)
    {
        try{
            $this->validateConfig($config);
            $this->createConnection($config);
        }catch(PDOException $e){
            throw new Exception('Connection error');
        }
    }   

    private function createConnection(array $config):void
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']}";
        $this->conn = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $this->conn->query("SET NAMES 'utf8'");
    }

    private function validateConfig(array $config):void
    {
        if(
            empty($config['host']) ||
            empty($config['database']) ||
            empty($config['user']) ||
            empty($config['password'])
            ){
                throw new PDOException('Storage configuration error');
            }
    }

    public function uploadFile(array $files, string $directory, string $fileName, bool $withNumber = false):bool
    {
        $filesNumber = 0;
        for($i = 0; $i < count($files); $i++){
            $inputNames = array_keys($files);
            if($files[($inputNames[$i])]['error'] === 0 ){
                $filesNumber++;
            }
        }
        for($i = 0; $i < $filesNumber; $i++){
        if($files[($inputNames[$i])]['error'] === 0){
            if($files[($inputNames[$i])]['type'] == 'image/png' || $files[($inputNames[$i])]['type'] == 'image/jpeg'){
                $target_dir = "C:/xampp/htdocs/projekt-kultura/public/graphics/$directory/";
                if($withNumber){
                    $target_file = $target_dir . $fileName . "_".($i+1).".png";
                }else{
                    $target_file = $target_dir . $fileName . ".png";
                }
            
                if(!move_uploaded_file($files[($inputNames[$i])]["tmp_name"], $target_file)) 
                {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        }
        return true;
    }

    public function uploadVideo(array $files, string $directory, string $fileName):bool
    {
        if($files[array_keys($files)[0]]['error'] === 0){
            if($files[array_keys($files)[0]]['type'] == 'video/mp4'){
                $target_dir = "C:/xampp/htdocs/projekt-kultura/public/graphics/$directory/";
                $target_file = $target_dir . $fileName . ".mp4";
            
                if(!move_uploaded_file($files[array_keys($files)[0]]["tmp_name"], $target_file)) 
                {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        return true;
    }
}