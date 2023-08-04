<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Controller\ForumController;

    class PostManager extends Manager
    {

        protected $className = "Model\Entities\Post";
        protected $tableName = "message";


        public function __construct()
        {
            parent::connect();
        }

        public function findPostsByTopic($id, $order = null)
        {    
            $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

            $sql = "SELECT a.message , a.creationDate, a.id_message, a.user_id
                    FROM ".$this->tableName." a
                    WHERE topic_id = :id
                    ".$orderQuery;
   
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findPostsByUser($id, $order = null)
        {    
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";
                
            $sql = "SELECT a.message , a.creationDate 
                    FROM ".$this->tableName." a
                    WHERE user_id = :id
                    ".$orderQuery;
   
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function editPost($id, $message)
        {

            $sql = "UPDATE ".$this->tableName." p
                    SET p.message = :message
                    WHERE p.id_".$this->tableName." = :id
                    ";

            return DAO::update($sql,[
                    ":id" => $id,
                    ":message" =>$message
            ]);

        }

        
    }