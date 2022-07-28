<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $email;
        private $password;
        private $roles;
        private $registerDate;
        

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
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of password
        
         */ 
        public function getPassword()
        {
                return $this->password
    ;
        }

        /**
         * Set the value of password
        
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        

        /**
         * Get the value of roleMember
         */ 
        public function getRoles()
        {
                return $this->roles;
        }

        /**
         * Set the value of roleMember
         *
         * @return  self
         */ 
        public function setRoles($roles)
        {
                $this->roles = json_decode($roles);

                if (empty($this->roles)) {
                        $this->$roles = "ROLE_USER";
                }

                return $this;
        }

        public function hasRole($role)
        {
                return in_array($role, $this->getRoles());
        }

        /**
         * Get the value of mail
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getRegisterDate()
        {
                $formattedDate = $this->registerDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }
    
        public function setRegisterDate($date)
        {
        $this->registerDate = new \DateTime($date);
        
        
        return $this;
        }

        public function __toString()
        {
                return $this->getPseudo();
        }
       
    }
