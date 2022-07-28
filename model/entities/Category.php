<?php
    namespace Model\Entities;

    use App\Entity;

    final class Category extends Entity{

        private $id;
        private $categoryName;
        private $nbTopics;
        

        public function __construct($data){         
            $this->hydrate($data);        
        }


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of categorieName
         */ 
        public function getCategoryName()
        {
                return $this->categoryName;
        }

        /**
         * Set the value of categorieName
         *
         * @return  self
         */ 
        public function setCategoryName($categoryName)
        {
                $this->categoryName = $categoryName;

                return $this;
        }

        /**
         * Get the value of nbTopics
         */ 
        public function getNbTopics()
        {
                return $this->nbTopics;
        }

        /**
         * Set the value of nbTopics
         *
         * @return  self
         */ 
        public function setNbTopics($nbTopics)
        {
                $this->nbTopics = $nbTopics;

                return $this;
        }

        public function __toString()
        {
                return $this->getCategoryName();
        }
    }