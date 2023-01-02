<?php
    namespace Model\Entities;

    use App\Entity;

    final class Categorie extends Entity{

        private $id;
        private $categorieName;
        

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
        public function getCategorieName()
        {
                return $this->categorieName;
        }

        /**
         * Set the value of categorieName
         *
         * @return  self
         */ 
        public function setCategorieName($categorieName)
        {
                $this->categorieName = $categorieName;

                return $this;
        }
    }