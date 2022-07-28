<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Controller\ForumController;
    use Model\Entities\Category;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }


        public function editCategory($id, $categoryName)
        {

            $sql = "UPDATE ".$this->tableName." c
                    SET c.categoryName = :categoryName
                    WHERE c.id_".$this->tableName." = :id
                    ";

            return DAO::update($sql,[
                    ":id" => $id,
                    ":categoryName" =>$categoryName
            ]);

        }

        public function searchAll($data)
        {
            $sql ='SELECT c.categoryName, id_category
                    FROM '.$this->tableName.' c
                    WHERE c.categoryName LIKE "%'.$data.'%"'
            ;
    
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function findAllCategories($order =null){
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT c.id_category, c.CategoryName, COUNT(t.category_id) AS nbTopics
                    FROM " .$this ->tableName."  c
                    LEFT JOIN topic t ON c.id_category = t.category_id
                    GROUP BY c.id_category
                    ".$orderQuery;
                ;

    
            return  $this -> getMultipleResults(
                    DAO::select($sql),
                    $this -> className
    
            );
    
        }
    }