<?php
    class Profile
    {
        private $name;
        private $gender;
        private $admittance_date;
        private $breed;
        private $id;
        private $specie_id;

        function __construct($id = null, $name, $gender, $breed, $specie_id, $admittance_date)
        {
            $this->name = $name;
            $this->gender = $gender;
            $this->breed = $breed;
            $this->id = $id;
            $this->specie_id = $specie_id;
            $this->admittance_date = $admittance_date;
        }
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }
        function setGender($new_gender)
        {
            $this->gender = (string) $new_gender;
        }

        function getGender()
        {
            return $this->gender;
        }
        function setBreed($new_breed)
        {
            $this->breed = (string) $new_breed;
        }

        function getBreed()
        {
            return $this->breed;
        }
        function getId()
        {
            return $this->id;
        }
        function getSpecieId()
        {
            return $this->specie_id;
        }
        function setAdmittanceDate($new_admittance_date)
        {
            $this->admittance_date = (string) $new_admittance_date;
        }
        function getAdmittanceDate()
        {
            return $this->admittance_date;
        }



        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO profiles (name, gender, breed, id, admittance_date, specie_id) VALUES ('{$this->getName()}','{$this->getGender()}', '{$this->getBreed()}', {$this->getId()}, '{$this->getAdmittanceDate()}',  {$this->getSpecieId()})");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_profiles = $GLOBALS['DB']->query("SELECT * FROM profiles;");
            $profiles = array();
            foreach($returned_profiles as $profile) {
                $name = $profile['name'];
                $gender = $profile['gender'];
                $breed = $profile['breed'];
                $id = $profile['id'];
                $admittance_date = $profile['admittance_date'];
                $specie_id = $profile['specie_id'];
                $new_profile = new Profile($id, $name, $gender, $breed, $specie_id, $admittance_date);
                array_push($profiles, $new_profile);
            }
            return $profiles;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM profiles;");
        }

        static function find($search_id)
        {
            $found_profile = null;
            $profiles = Profile::getAll();
            foreach($profiles as $profile) {
                $profile_id = $profile->getId();
                if ($profile_id == $search_id) {
                  $found_profile = $profile;
                }
            }
            return $found_profile;
        }
    }
?>
