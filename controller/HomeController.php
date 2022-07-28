<?php


namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
    
    
    class HomeController extends AbstractController implements ControllerInterface
    {

        public function index()
        {           
            $categoryManager = new CategoryManager();
           
            return [
                "view" => VIEW_DIR."home.php",
                "data" => [
                    "categories" => $categoryManager->findAllCategories(["categoryName", 'ASC'])
                ]
            ];
        }
        
        /********************************************************User****************************************************************************************/

   
        public function users()
        {

            $manager = new UserManager();
            $users = $manager->findAll(['registerdate', 'DESC']);

            return [
                "view" => VIEW_DIR."security/listUsers.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function forumRules()
        {
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        public function detailUser($id)
        {

            $userManager = new UserManager();
            $postManager = new PostManager();
            $topicManager = new TopicManager();


            return [
                "view" => VIEW_DIR."security/detailUser.php",
                "data" => [
                    "user" => $userManager->findOneById($id),
                    "posts" => $postManager->findPostsByUser($id),
                    "topics" => $topicManager->findTopicsByUser($id)
                ]
            ];
            header("Location: index.php?crtl=Forum&action=listUsers");
          
            
        }


        public function deleteUser($id)
        {
            $userManager = new UserManager();
           
            $User = $userManager->findOneById($id);

            $userManager->delete($id);     
            
            $this->redirectTo("security", "listUsers");
           
        }

        public function editUser($id)
        {   
            $userManager = new UserManager();
            $user = $userManager->findOneByPseudo($_SESSION["user"]->getPseudo());
            //$userid = $userManager->findOneByPseudo($_SESSION["user"]->getId());

            if (!empty($_POST)) {

                $updatedPseudo = filter_input(INPUT_POST, 'pseudo' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $updatedEmail = filter_input(INPUT_POST, 'email' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $userManager->editUser($id, $updatedPseudo, $updatedEmail);
                
                unset($_SESSION["user"]);
                $this->redirectTo("security", "login");
                
            }

            return [
                "view" => VIEW_DIR."security/editUser.php",
                "data" => [
                    "user" => $user,
                ]
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
