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

    class SecurityController extends AbstractController implements ControllerInterface
    {

        public function index()
        {  
           
        }

        public function registerForm()
        {
            return [
                'view' => VIEW_DIR.'security/register.php',
                'data' => null
            ];

        }

      
        public function register()
        {
            $error = new Session();

            if (!empty($_POST)) {

                $nickname = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $avatar = filter_input(INPUT_POST, 'avatar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, [
                    "options" =>[
        
                        //il faut une majuscule minuscule un numero et un caractère speciale et au moins 8 caractère
                        "regexp" => '#^[A-Za-z][A-Za-z0-9_]{5,29}$#'    
                    ]
                ]);
                $confirmPass = filter_input(INPUT_POST, 'confirmPass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           /*
                if(isset($_FILES['file'])){

                    $tempName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];
                    $type = $_FILES['file']['type'];
                
                
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                
                    $extensionAutorisees = ['jpg', 'jpeg', 'gif', 'png'];
                    $taileMax = 4000000;
                
                    if(in_array($extension, $extensionAutorisees) && $size <= $taileMax && $error == 0){
                
                        $uniqueName = uniqid('', true);
                        $fileName = $uniqueName.'.'.$extension;
                        move_uploaded_file($tempName, './upload/' .$fileName); 
                
                    }
                }
            */

                if ($nickname && $email && $password) {

                    if (($password == $confirmPass) and strlen($password) >= 8 ) {

                        $manager = new UserManager();
                        $user = $manager->findOneByPseudo($nickname);

                        if (!$user) {

                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if ($manager->add([
                                'pseudo' => $nickname,
                                'email' => $email,
                                'password' => $hash,
                                'roles' => json_encode(['ROLE_USER'])
                            ])){

                                return [
                                    'view' => VIEW_DIR.'security/login.php',
                                ];  
                            }

                        }else{
   
                            Session::addFlash('error', 'This pseudo user is already taken !'); 
                        }

                    } else {

                        Session::addFlash('error', 'Some problem in password !');
                    }

                } else {
                    
                    Session::addFlash('error', 'You need full all the form !');
                }

            }

            return [
                'view' => VIEW_DIR.'security/register.php',
            ];
        }


        public function loginForm()
        {
            return [
                'view' => VIEW_DIR.'security/login.php',
                'data' => null
            ];

        }


        public function login()
        {
            
            if (!empty($_POST)) {
                
                $nickname = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if ($nickname && $password) {

                    $manager = new UserManager();
                    $user = $manager->findOneByPseudo($nickname);

                    if ($user) {
 
                        $passControl = $manager->userPass($nickname);
                        
                        $hashed_password = $passControl->getPassword();
                        
                        if (password_verify($password, $hashed_password)) {
                        
                            Session::setUser($user);
                            
                            $this->redirectTo("forum", "listCategories");
                            die();
                        }
                    }
                }
            }

            return [
                'view' => VIEW_DIR.'security/login.php',
            ];
        }


       
        public function modifyPassword()
        {

            if (!empty($_POST)) {
    
                
                $password = filter_input(INPUT_POST,'password',FILTER_VALIDATE_REGEXP,[
    
                    "options"=> [
    
                        "regexp" => '#^[A-Za-z][A-Za-z0-9_]{5,29}$#'
    
                        ]
    
                    ]);
                $passwordConfirm = filter_input(INPUT_POST,'confirmPass',FILTER_VALIDATE_REGEXP,[
    
                    "options"=> [
    
                        "regexp" => '#^[A-Za-z][A-Za-z0-9_]{5,29}$#'
    
                        ]
    
                    ]);
    
                    
                if($password == $passwordConfirm){   

                    $nickname = $_SESSION["user"];

                    $userManager = new UserManager();
    
                    $hashPass = password_hash($password, PASSWORD_DEFAULT);  
                    
                    $row = $userManager -> modidyPassword($nickname, $hashPass);

                    Session::addFlash('success', 'Your password has been changed !'); 
                }
                
                
            }
    
            return[
    
                "view" => VIEW_DIR."security/editPassword.php",
    
                "data" => [],
    
            ];
        
        }

        
        public function logout()
        {
            if ($_SESSION['user']) {

                unset($_SESSION['user']);

                $this->redirectTo(' DEFAULT_CTRL');

            }
        }

    }
