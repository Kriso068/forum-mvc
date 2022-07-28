<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Controller\HomeController;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findOneByPseudo($data)
        {
            $sql = "SELECT u.pseudo, u.id_user, u.roles, u.email
                FROM ".$this->tableName." u
                WHERE u.pseudo = :pseudo
                ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $data], false), 
                $this->className
            );
        }


        public function userPass($nickname)
        {
            $sql = "SELECT u.password
                FROM ".$this->tableName." u
                WHERE u.pseudo = :pseudo
                ";
                
                return $this->getOneOrNullResult(
                    DAO::select($sql, ['pseudo' => $nickname], false), 
                    $this->className
                );
              
        }

        public function modidyPassword($nickname, $password)
        {
            $sql = "UPDATE ".$this->tableName." u
                    SET u.password = :password
                    WHERE u.pseudo = :pseudo
                    ";

            return DAO::update($sql,[
                    ":pseudo" => $nickname,
                    ":password" => $password
            ]);
        }


        public function editUser($id, $nickname, $email)
        {
            $sql = "UPDATE ".$this->tableName." u
                    SET u.pseudo = :pseudo, u.email = :email
                    WHERE u.id_".$this->tableName." = :id
                    ";

            return DAO::update($sql, [
                    ":pseudo" => $nickname,
                    ":email" => $email,
                    ":id" => $id
            ]);
        }
    }