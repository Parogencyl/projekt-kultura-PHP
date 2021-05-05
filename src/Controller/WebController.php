<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request;
use App\Model\BlogModel;
use App\Model\CourseModel;
use App\Model\WorkshopModel;
use App\Model\TeamModel;
use App\View;
use Exception;

class WebController extends AbstractController
{
    protected Request $request;
    protected BlogModel $blogModel;
    protected CourseModel $courseModel;
    protected WorkshopModel $workshopModel;
    protected TeamModel $teamModel;
    protected View $view;

    public function __construct(Request $request)
    {
        if(empty(self::$configuration['db'])){
            throw new Exception('Configuration error');
        }
        $this->request = $request; 
        $this->blogModel = new BlogModel(self::$configuration['db']);
        $this->courseModel = new CourseModel(self::$configuration['db']);
        $this->workshopModel = new WorkshopModel(self::$configuration['db']);
        $this->teamModel = new TeamModel(self::$configuration['db']);
        $this->view = new View();
    }

    public function mainPage():void
    {

        $pageSize = (int) $this->request->getParam('pageSize', self::NUMBER_OF_POSTS);
        $pageNumber = (int) $this->request->getParam('pageNumber', 1);
        
        $blogPosts = $this->blogModel->getPosts($pageSize, $pageNumber);
        $numberOfPosts = $this->blogModel->countPosts();

        var_dump($blogPosts);

        $this->view->render(
            'main',
            [
                'posts' => $blogPosts,
                'page' => [
                    'size' => $pageSize,
                    'current' => $pageNumber,
                    'number' => (int) ceil($numberOfPosts/$pageSize)
                ]
            ]
        );
    }

    public function blogPage():void
    {
        $articleName = $this->request->getParam('name');
        $article = $this->blogModel->getPost($articleName);

        $this->view->render(
            'blog',
            [
                'article' => $article
            ]
        );
    }

    public function coursesShopPage():void
    {
        if($this->request->isPost()){
            $data = [
                'name' => $this->request->postParam('name'),
                'key' => $this->request->postParam('key')
            ];
            if($this->courseModel->checkKey($data)){
                header("Location: /projekt-kultura/?page=course&name={$data['name']}&key={$data['key']}");
                exit();
            }else {
                header("Location: /projekt-kultura/?page=coursesShop&error=notValidKey");
                exit();
            }
        }

        $courses = $this->courseModel->getCourses();
        $courses = $this->variantsRefactoring($courses);
        $courses = $this->whatYouGetRefactoring($courses);

        $this->view->render(
            'coursesShop',
            [
                'courses' => $courses,
                'variantSize' => $this->getCoursesSize($courses),
                'courseDuration' => $this->getCoursesTime($courses),
                'key' => $this->request->getParam('key'),
                'name' => $this->request->getParam('name'),
                'error' => $this->request->getParam('error')
            ]
        );
    }

    public function coursePage():void
    {
        $data = [
            'name' => $this->request->getParam('name'),
            'key' => $this->request->getParam('key')
        ];

        if($this->courseModel->checkKey($data)){
            $course = $this->courseModel->getCourse($data['name']);

            $this->view->render(
                'course',
                [
                    'course' => $course,
                    'key' => $data['key']
                ]
            );
        }
    }

    public function paymentFormCoursePage():void
    {
        if($this->request->isPost()){
            $data = [
                'email' => $this->request->postParam('email'),
                'name' => $this->request->postParam('name'),
                'surname' => $this->request->postParam('surname'),
                'variant' => $this->request->postParam('variant'),
                'name_of_course' => $this->request->postParam('name_of_course'),
            ];
            $this->courseModel->generateKey($data);
        }

        $nameCourse = $this->request->getParam('name');
        $variant = $this->request->getParam('variant');
        $course = $this->courseModel->getCourse($nameCourse);
        $course = $this->variantsReplaceCharacter($course);
        $price = $this->courseModel->getPrice($variant, $nameCourse);

        $this->view->render(
            'paymentFormCourse',
            [
                'course' => $course,
                'variant' => $variant,
                'price' => $price,
                'error' => $this->request->getParam('error')
            ]
        );
    }

    public function workshopsPage():void
    {
        $workshops = $this->workshopModel->getWorkshops();

        $this->view->render(
            'workshops',
            [
                'workshops' => $workshops
            ]
        );
    }

    public function workshopPage():void
    {
        $nameWorkshop = $this->request->getParam('name');
        $workshop = $this->workshopModel->getWorkshop($nameWorkshop);

        $this->view->render(
            'workshop',
            [
                'workshop' => $workshop
            ]
        );
    }

    public function paymentFormWorkshopPage():void
    {
        $nameWorkshop = $this->request->getParam('name');
        $workshop = $this->workshopModel->getWorkshop($nameWorkshop);

        $this->view->render(
            'paymentFormWorkshop',
            [
                'workshop' => $workshop,
            ]
        );
    }

    public function teamsPage():void
    {
        $teams = $this->teamModel->getTeams();

        $this->view->render(
            'teams',
            [
                'teams' => $teams
            ]
        );
    }

    public function teamPage():void
    {
        $nameTeam = $this->request->getParam('name');
        $team = $this->teamModel->getTeam($nameTeam);

        $this->view->render(
            'team',
            [
                'team' => $team
            ]
        );
    }

    public function aboutPage():void
    {
        $this->view->render('about');
    }

}