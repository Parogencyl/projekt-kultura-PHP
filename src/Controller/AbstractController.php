<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use App\View;

abstract class AbstractController
{
    private const DEFAULT_PAGE = 'main';
    private const ADMIN_DEFAULT_PAGE = 'login';
    protected const NUMBER_OF_POSTS = 4;
    protected static array $configuration = [];

    protected View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    final public function run(bool $isAdmin = false):void
    {
        $page = $this->page() . 'Page';
        if(!method_exists($this, $page)){
            if(!$isAdmin){
                $page = self::DEFAULT_PAGE . 'Page';
            }else{
                $page = self::ADMIN_DEFAULT_PAGE . 'Page';
            }
        }
        if($isAdmin){
            session_start();
            if($page != 'registerPage' && $page != 'forgetPassword'){
                if(isset($_SESSION['loggedin'])){
                    if($_SESSION['loggedin'] !== true){
                        $page = self::ADMIN_DEFAULT_PAGE . 'Page';
                    }
                }else {
                    $page = self::ADMIN_DEFAULT_PAGE . 'Page';
                }
            }
        }
        $this->$page();
    }

    final private function page():string
    {
        return $this->request->getParam('page', self::DEFAULT_PAGE);
    }

    final protected function redirect(string $to, array $params, bool $isAdmin = false)
    {
        $location = $to;
        if(count($params)){
            $queryParams = [];
            foreach($params as $key => $value){
                $queryParams[] = urlencode($key).'='.urlencode($value);
            }
            $queryParams = implode('&', $queryParams);
            $location .= '?'.$queryParams; 
        }
        if($isAdmin){
            header("Location: /projekt-kultura/admin.php$location");
        }else {
            header("Location: /projekt-kultura$location");
        }
        exit;
    }

    protected function variantsReplaceCharacter(array $course):array
    {
        for($i = 1; $i < 4; $i++){
            if($course['variant'.$i] != null){
                if(strpos($course['variant'.$i], '|')){
                    $course['variant'.$i] = str_replace('|', ' + ', $course['variant'.$i]);
                }
            }
        }
        return $course;
    }
    
    protected function whatYouGetRefactoring(array $courses):array
    {
        $index = 0;
        foreach($courses as $course){
            foreach($course as $key => $value){
                if($key == 'about'){
                    if(strpos($value, '|')){
                        $el = $value;
                        $text = [];
                        for ($i=0; $i < substr_count($value, '|')+1; $i++) { 
                            $pos = strpos($el, '|');
                            if($pos != false){
                                $text[] = substr($el, 0, $pos);
                                $el = substr_replace($el, '', 0, $pos+1);
                            }else {
                                $text[] = substr($el, 0);
                                $el = substr_replace($el, '', 0);
                            }
                        }
                        $courses[$index][$key] = $text;
                    } else {
                        $helper[0] = $value;
                        $courses[$index][$key] = $helper;
                    }
                }
            }
            $index++;
        }
        return $courses;
    }

    protected function variantsRefactoring(array $courses):array
    {
        $index = 0;

        foreach($courses as $course){
            foreach($course as $key => $value){
                if($key == 'variant1' || $key == 'variant2' || $key == 'variant3'){
                    if($value == null){
                        $helper[0] = null;
                        $courses[$index][$key] = $helper;
                    } else if(strpos($value, '|')){
                        $el = $value;
                        $text = [];
                        for ($i=0; $i < substr_count($value, '|')+1; $i++) { 
                            $pos = strpos($el, '|');
                            if($pos != false){
                                $text[] = substr($el, 0, $pos);
                                $el = substr_replace($el, '', 0, $pos+1);
                            }else {
                                $text[] = substr($el, 0);
                                $el = substr_replace($el, '', 0);
                            }
                        }
                        $courses[$index][$key] = $text;
                    } else {
                        $helper[0] = $value;
                        $courses[$index][$key] = $helper;
                    }
                }
            }
            $index++;
        }
        return $courses;
    }

    protected function getCoursesTime(array $courses):array
    {
        foreach($courses as $course){
            if(substr(date('H', strtotime($course['duration'])), 0, 1) === '0'){
                $time[] = substr(date('H', strtotime($course['duration'])), -1).'+';
            }else {
                $time[] = date('H', strtotime($course['duration'])).'+';
            }
        }
        return $time;
    }

    protected function getCoursesSize(array $courses):array
    {
        foreach($courses as $course){
            if(sizeof($course['variant1']) <= sizeof($course['variant2'])){
                if(sizeof($course['variant3']) <= sizeof($course['variant2'])){
                    $variantSize[] = sizeof($course['variant2']);
                } else {
                    $variantSize[] = sizeof($course['variant3']);
                }
            }else {
                if(sizeof($course['variant1']) <= sizeof($course['variant3'])){
                    $variantSize[] = sizeof($course['variant3']);
                } else {
                    $variantSize[] = sizeof($course['variant1']);
                }
            }
        }
        return $variantSize;
    }

}