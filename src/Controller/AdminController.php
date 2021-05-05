<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\Admin\AccoundModel;
use App\Model\Admin\BlogModel;
use App\Model\Admin\WorkshopsModel;
use App\Model\Admin\TeamsModel;
use App\Model\Admin\CourseModel;
use App\Request;
use App\View;

class AdminController extends AbstractController
{

    protected AccoundModel $accoundModel;
    protected BlogModel $blogModel;
    protected WorkshopsModel $workshopsModel;
    protected TeamsModel $teamsModel;
    protected CourseModel $courseModel;
    protected Request $request;
    protected View $view;

    public function __construct(Request $request)
    {
        $this->accoundModel = new AccoundModel(self::$configuration['db']);
        $this->blogModel = new BlogModel(self::$configuration['db']);
        $this->workshopsModel = new WorkshopsModel(self::$configuration['db']);
        $this->teamsModel = new TeamsModel(self::$configuration['db']);
        $this->courseModel = new CourseModel(self::$configuration['db']);
        $this->request = $request; 
        $this->view = new View();
    }

    public function loginPage():void
    {
        if($this->request->isPost()){
            $loginData = [
                'email' => htmlentities($this->request->postParam('email')),
                'password' => htmlentities($this->request->postParam('password'))
            ];
            if(!empty($loginData['email']) &&
             !empty($loginData['password'])){
                if($this->accoundModel->login($loginData)){
                    $this->redirect('/', ['page' => 'main'], true);
                }else{
                    $this->redirect('/', ['error' => 'wrongData'], true);
                }
            } else {
                $this->redirect('/', ['error' => 'emptyForm'], true);
            }
        }

        $this->view->render(
            'login',
            [
                'error' => $this->request->getParam('error')
            ],
            true
        );
    } 

    public function registerPage():void
    {
        if($this->request->isPost()){
            $accoundData = [
                'name' => htmlentities($this->request->postParam('name')),
                'email' => htmlentities($this->request->postParam('email')),
                'password' => htmlentities($this->request->postParam('password')),
                'password_confirmation' => htmlentities($this->request->postParam('password_confirmation'))
            ];

            $email = $accoundData['email'];

            if(!empty($email)){
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $this->redirect("/", ['page' => 'register', 
                        'errorEmail' => 'emailCharacters'], true);  
                    } else {
                        if($this->accoundModel->checkEmail($email)){
                            $this->redirect("/", ['page' => 'register', 
                                'errorEmail' => 'emailTaken'], true);  
                        }
                    }
            } else {
                $this->redirect("/", ['page' => 'register', 
                    'errorEmail' => 'emptyEmail'], true);  
            }

            $accoundData['password'] = $this->passwordValidate('register', $accoundData['password'], 
            $accoundData['password_confirmation']);

            $this->accoundModel->register($accoundData);
        }

        $this->view->render(
            'register',
            [
                'errorPassword' => $this->request->getParam('errorPassword'),
                'errorEmail' => $this->request->getParam('errorEmail')
            ],
            true
        );
    } 

    public function forgetPasswordPage():void
    {
        $this->view->render(
            'forgetPassword',
            [],
            true
        );
    } 

    public function mainPage():void
    {
        if($this->request->isPost()){
            $id = (int) $this->request->postParam('el');
            if($this->request->getParam('action') === 'addBaner'){
                $this->blogModel->addBaner($id);
            } else if($this->request->getParam('action') === 'deleteBaner'){
                $this->blogModel->deleteBaner($id);
            }
        }

        $pageSize = (int) $this->request->getParam('pageSize', self::NUMBER_OF_POSTS);
        $pageNumber = (int) $this->request->getParam('pageNumber', 1);
        
        $blogPosts = $this->blogModel->getPosts($pageSize, $pageNumber);
        $numberOfPosts = $this->blogModel->countPosts();

        $this->view->render(
            'main',
            [
                'posts' => $blogPosts,
                'page' => [
                    'size' => $pageSize,
                    'current' => $pageNumber,
                    'number' => (int) ceil($numberOfPosts/$pageSize)
                ],
                'success' => $this->request->getParam('success'),
                'error' => $this->request->getParam('error')
            ],
                true
        );
    }

    public function addPostPage():void
    {
        if($this->request->isPost()){
            $postData = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
                'text' => $this->request->postParam('text'),
                'image' => $this->request->postParam('image')
            ];

            $this->blogModel->addPost($postData);
        }

        $this->view->render(
            'addPost',
            [
                'success' => $this->request->getParam('success'),
                'error' => $this->request->getParam('error')
            ],
            true
        );
    } 

    public function managePostPage():void
    {
        if($this->request->isPost()){
            $postData = [
                'id' => $this->request->postParam('id'),
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
                'text' => $this->request->postParam('text')
            ];

            $this->blogModel->updatePost($postData);
        }

        $postName = $this->request->getParam('name');
        $post = $this->blogModel->getPost($postName);
        
        $this->view->render(
            'managePost',
            [
                'post' => $post,
                'success' => $this->request->getParam('success'),
                'error' => $this->request->getParam('error')
            ],
            true
        );
    } 

    public function teamsPage():void
    {
        $teams = $this->teamsModel->getTeams();
        
        $this->view->render(
            'teams',
            [
                'teams' => $teams,
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 

    public function addTeamPage():void
    {
        if($this->request->isPost()){
            $teamData = [
                'name' => $this->request->postParam('name'),
                'description' => $this->request->postParam('description')
            ];
            $this->teamsModel->addTeam($teamData);
        }
        $this->view->render(
            'addTeam',
            [
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 

    public function manageTeamPage():void
    {
        if($this->request->isPost()){
            $teamData = [
                'id' => $this->request->postParam('id'),
                'name' => $this->request->postParam('name'),
                'description' => $this->request->postParam('description'),
            ];

            $this->teamsModel->updateTeam($teamData);
        }

        if($this->request->getParam('action') === 'delete'){
            $id = (int) $this->request->getParam('id');
            $name = $this->request->getParam('name');
            $this->teamsModel->deleteTeam($id, $name);
        }

        $name = $this->request->getParam('name');
        $team = $this->teamsModel->getTeam($name);
        
        $this->view->render(
            'manageTeam',
            [
                'team' => $team,
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 


    public function workshopsPage():void
    {
        $workshops = $this->workshopsModel->getWorkshops();

        $this->view->render(
            'workshops',
            [
                'workshops' => $workshops,
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 

    public function addWorkshopPage():void
    {
        if($this->request->isPost()){
            $workshopData = [
                'name' => $this->request->postParam('name'),
                'description' => $this->request->postParam('description'),
                'forSale' => $this->request->postParam('forSale'),
                'price' => $this->request->postParam('price')
            ];
            $this->workshopsModel->addWorkshop($workshopData);
        }
        
        $this->view->render(
            'addWorkshop',
            [
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 

    public function manageWorkshopPage():void
    {
        if($this->request->isPost()){
            $workshopData = [
                'id' => $this->request->postParam('id'),
                'name' => $this->request->postParam('name'),
                'description' => $this->request->postParam('description'),
                'forSale' => $this->request->postParam('forSale'),
                'price' => $this->request->postParam('price')
            ];
            $this->workshopsModel->updateWorkshop($workshopData);
        }

        if($this->request->getParam('action') === 'delete'){
            $id = (int) $this->request->getParam('id');
            $name = $this->request->getParam('name');
            $this->workshopsModel->deleteWorkshop($id, $name);
        }

        $name = $this->request->getParam('name');
        $workshop = $this->workshopsModel->getWorkshop($name);
        
        $this->view->render(
            'manageWorkshop',
            [
                'workshop' => $workshop,
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    } 

    public function coursesShopPage():void
    {
        if($this->request->isPost()){
            if($this->request->getParam('action') === 'addVideo'){
                $this->courseModel->uploadAdvertisement();
            } else if($this->request->getParam('action') === 'deleteVideo'){
                $this->courseModel->deleteAdvertisement();
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
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    }

    public function addCoursePage():void
    {
        if($this->request->isPost()){
            $addCourseData = [
                'name' => $this->request->postParam('name'),
                'duration' => $this->request->postParam('duration'),
                'price1' => $this->request->postParam('price1'),
                'variant1' => $this->request->postParam('variant1'),
                'price2' => $this->request->postParam('price2'),
                'variant2' => $this->request->postParam('variant2'),
                'price3' => $this->request->postParam('price3'),
                'variant3' => $this->request->postParam('variant3'),
                'learn' => $this->request->postParam('learn'),
            ];
            $this->courseModel->addCourse($addCourseData);
        }

        $this->view->render(
            'addCourse',
            [
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    }

    public function manageCoursePage():void
    {
        if($this->request->isPost()){
            if($this->request->postParam('submit') == 'submit'){
                $manageCourseData = [
                    'name' => $this->request->postParam('name'),
                    'duration' => $this->request->postParam('duration'),
                    'price1' => $this->request->postParam('price1'),
                    'variant1' => $this->request->postParam('variant1'),
                    'price2' => $this->request->postParam('price2'),
                    'variant2' => $this->request->postParam('variant2'),
                    'price3' => $this->request->postParam('price3'),
                    'variant3' => $this->request->postParam('variant3'),
                    'learn' => $this->request->postParam('learn'),
                ];
                $this->courseModel->editCourse($manageCourseData);
            } else if($this->request->postParam('submit') == 'delete'){
                $this->courseModel->deleteCourse($this->request->postParam('name'));
            }
        }

        $name = $this->request->getParam('name');
        $data = $this->courseModel->getCourse($name);

        $this->view->render(
            'manageCourse',
            [
                'course' => $data,
                'error' => $this->request->getParam('error'),
                'success' => $this->request->getParam('success')
            ],
            true
        );
    }

    private function passwordValidate(string $page, string $password, string $passwordConfirmation = null):string
    {
        $number = preg_match('@[0-9]@', $password);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);

        if(!empty($password) && !empty($passwordConfirmation)){
            if(strlen($password) >= 8 && $number && $uppercase && $lowercase){
                if($password === $passwordConfirmation){
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    return $password;
                }else {
                    $this->redirect("/", ['page' => $page, 
                        'errorPassword' => 'passwordConfirmation'], true);
                }
            } else {
                $this->redirect("/", ['page' => $page, 
                'errorPassword' => 'passwordCharacters'], true);  
            }
        } else {
            $this->redirect("/", ['page' => $page, 
                'errorPassword' => 'emptyPassword'], true);
        }
    }

}