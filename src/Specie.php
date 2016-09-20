<?php
    class Specie
    {
        private $id;
        private $type;


        function __construct($id = null, $type)
        {
            $this->type = $type;
            $this->id = $id;
        }

        function setType($new_type)
        {
            $this->type = (string) $new_type;
        }

        function getType()
        {
            return $this->type;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO species (type) VALUES ('{$this->getType()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_species = $GLOBALS['DB']->query("SELECT * FROM species;");
            $species = array();
            if(!empty($returned_species)){
                foreach($returned_species as $specie) {
                    $type = $specie['type'];
                    $id = $specie['id'];
                    $new_specie = new Specie($id, $type);
                    array_push($species, $new_specie);
                }
            }
            return $species;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM species;");
        }

        static function find($search_id)
        {
            $found_specie = null;
            $species = Specie::getAll();
            foreach($species as $specie) {
                $specie_id = $specie->getId();
                if ($specie_id == $search_id) {
                  $found_specie = $specie;
                }
            }
            return $found_specie;
        }

        function getProfiles()
        {
            $profiles = Array();
            $returned_profiles = $GLOBALS['DB']->query("SELECT * FROM profiles WHERE specie_id = {$this->getId()} ORDER BY admittance_date;");
            foreach($returned_profiles as $profile) {
                $name = $profile['name'];
                $gender = $profile['gender'];
                $breed = $profile['breed'];
                $id = $profile['id'];
                $admittance_date = $profile['admittance_date'];
                $specie_id = $profile['specie_id'];
                $url = $profile['url'];
                $new_profile = new Profile($id, $name, $gender, $breed, $specie_id, $admittance_date, $url);
                array_push($profiles, $new_profile);
            }
            return $profiles;
        }
        function update($new_type)
        {
            $GLOBALS['DB']->exec("UPDATE species SET type = '{$new_type}' WHERE id = {$this->getId()};");
            $this->setType($new_type);
        }
        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM species WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM profiles WHERE specie_id = {$this->getId()};");
        }
    }
?>
