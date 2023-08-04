<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Controller\ForumController;

    class TopicManager extends Manager
    {

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct()
        {
            parent::connect();
        }


        public function findTopicsByCategories($id, $order = null)
        {    

            $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

            $sql = "SELECT a.title , a.creationDate, a.id_topic
                    FROM ".$this->tableName." a
                    WHERE category_id = :id
                    ".$orderQuery;
   
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function findTopicsByUser($id, $order = null)
        {    
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT a.title , a.creationDate
                    FROM ".$this->tableName." a
                    WHERE user_id = :id
                    ".$orderQuery;
   
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }
      

        public function editTopic($id, $title)
        {

            $sql = "UPDATE ".$this->tableName." u
                    SET u.title = :title
                    WHERE u.id_".$this->tableName." = :id
                    ";

            return DAO::update($sql,[
                    ":id" => $id,
                    ":title" =>$title
            ]);

        }

        public function findAllTopics($order = null)
        {
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT t.user_id , t.closed, t.id_topic, t.title, COUNT(t.id_topic) AS nbmessages, t.creationdate AS creationDateTopic
                FROM ".$this->tableName." t
                LEFT JOIN message m ON t.id_topic = m.topic_id
                GROUP BY t.id_topic
                ".$orderQuery;
    

            return  $this -> getMultipleResults(
                    DAO::select($sql),
                    $this -> className
    
            );
    
        }
        
        public function closeTopic($id)
        {
            $sql = "UPDATE ".$this->tableName." t
            SET t.closed = 1
            WHERE t.id_".$this->tableName." = :id
            ";

            return DAO::update($sql,[
                    ":id" => $id,
                    
            ]);
        }

        public function openTopic($id)
        {
            $sql = "UPDATE ".$this->tableName." t
            SET t.closed = 0
            WHERE t.id_".$this->tableName." = :id
            ";

            return DAO::update($sql,[
                    ":id" => $id,  
            ]);
        }
        
    }