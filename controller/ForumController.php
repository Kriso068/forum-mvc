<?php

    namespace Controller;

    use App\DAO;
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface
    {

        public function index()
        {  
           $topicManager = new TopicManager();
          

             return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                "topics" => $topicManager->findAllTopics(['creationDateTopic', 'DESC']),         
                      
                ]
            ];
           /* return [
                "VIEW" => VIEW_DIR."home.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationdate", "DESC"]),         
                ]
            ];*/
        }


        

        /********************************************************Categories****************************************************************************************/




        /*********************************************************FONCTION EN COURS */
        public function searchBar()
        {
            $categoryManager = new CategoryManager();

            if (!empty($_POST)) {
      
                $_POST = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                $search = $categoryManager->searchAll($_POST);
                       
            }

            return [
                "view" => VIEW_DIR."forum/searchCategory.php",
                "data" => [
                "categories" => $search,         
                ]
            ];
        }


        public function listCategories()
        {
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["categoryName", "ASC"]),

                ]
            ];
        }

        public function detailCategorie($id)
        {

            $categoryManager = new CategoryManager();
            $topicManager = new TopicManager();
           
            return [
                "view" => VIEW_DIR."forum/detailCategorie.php",
                "data" => [
                    "categorie" => $categoryManager->findOneById($id),
                    "topics" => $topicManager->findTopicsByCategories($id, ["creationdate", "DESC"]), 
                ]
            ];
            
        }


        public function newCategory()
        {
            $categoryManager = new CategoryManager();  
            if (!empty($_POST)) {

                $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if($categoryName){

                    $categoryManager->add([
                        "categoryName" => $categoryName
                    ]);
                }
                
             $this->redirectTo("forum" , "listCategories");
            }

            return [
                "view" => VIEW_DIR."forum/addCategory.php"
            ];
        }

        public function deleteCategory($id)
        {
            $categoryManager = new CategoryManager();
           
            $category = $categoryManager->findOneById($id);

            $categoryManager->delete($id);
            
            $this->redirectTo("forum", "listCategories");

            die;
        }

        public function editCategory($id)
        {

            $categoryManager = new CategoryManager();
            $updateCategory = $categoryManager->findOneById($id);

            if (!empty($_POST['categoryName'])) {

                $categoryName = filter_input(INPUT_POST, 'categoryName' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $categoryManager->editCategory($id, $categoryName);

                $this->redirectTo("forum", "listCategories");
            }

            return [
                "view" => VIEW_DIR."forum/editCategory.php",
                "data" => [
                    "category" => $updateCategory,
                ]
            ];
        }



        /********************************************************Topics***************************************************************************************/

        public function detailTopic($id)
        {

            $topicManager = new TopicManager();
            $postManager = new PostManager(); 
               
            

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "topic" => $topicManager->findOneById($id),
                    "posts" => $postManager->findPostsByTopic($id, ["creationdate", "DESC"]),
                    
                ]
            ];
            
        }

        public function addTopic($id)
        {
            $topicManager = new TopicManager();   

            if (!empty($_POST)) {

                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $post = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                
                if ($title && $post) {

                    
               $idTopic = $topicManager->add([
                        "title" => $title,
                        "category_id" => $id,
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                   

                    $postManager = new PostManager();
                    //$dao = new DAO();

                    $postManager->add([
                        "message" => $post,
                        "topic_id" => $idTopic,
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                }


              $this->redirectTo("forum", "detailCategorie", $id);
             
            }

            return [
                "view" => VIEW_DIR."forum/addTopic.php"
            ];
                  
        }

        public function deleteTopic($id)
        {
            $topicManager = new TopicManager();
           
            $topic = $topicManager->findOneById($id);

            $topicManager->delete($id);
            
            $this->redirectTo("forum", "listTopics");

            die;
        }
        
        public function editTopic($id)
        {

            $topicManager = new TopicManager();
            $updateTopic = $topicManager->findOneById($id);

            if (!empty($_POST['title'])) {

                $title = filter_input(INPUT_POST, 'title' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $topicManager->editTopic($id, $title);

                $this->redirectTo("forum", "listTopics");
            }

            return [
                "view" => VIEW_DIR."forum/editTopic.php",
                "data" => [
                    "topic" => $updateTopic,
                ]
            ];
        }

        /********************************************************Posts***************************************************************************************/

        public function addPost($id)
        {
            $postManager = new PostManager();   

            if (!empty($_POST)) {

                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
                
                if($message){

                    $postManager->add([
                        "message" => $message,
                        "topic_id" => $id,
                        "user_id" => $_SESSION['user']->getId()
                    ]);
                }

              $this->redirectTo("forum", "detailTopic", $id);
            }

            return [
                "view" => VIEW_DIR."forum/addPost.php"
            ];
                  
        }

        public function deletePost($id)
        {
            $postManager = new PostManager();

            $post = $postManager->findOneById($id);

            $idTopic = $post->getTopic()->getId();

            $postManager->delete($id);
    
            $this->redirectTo("forum", "detailTopic", $idTopic);

            die;
        }

        public function editPost($id)
        {

            $postManager = new PostManager();
            $updatePost = $postManager->findOneById($id);

            if (!empty($_POST['message'])) {

                $message = filter_input(INPUT_POST, 'message' , FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $postManager->editPost($id, $message);

                $this->redirectTo("forum", "listTopics");
            }

            return [
                "view" => VIEW_DIR."forum/editPost.php",
                "data" => [
                    "post" => $updatePost,
                ]
            ];
        }
    }
