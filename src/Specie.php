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

        function getSpecies()
        {
            $species = Array();
            $returned_species = $GLOBALS['DB']->query("SELECT * FROM species WHERE specie_id = {$this->getId()} ORDER BY type;");
            foreach($returned_species as $specie) {
                $name = $specie['name'];
                $gender = $specie['gender'];
                $breed = $specie['breed'];
                $id = $specie['id'];
                $admittance_date = $specie['admittance_date'];
                $specie_id = $specie['specie_id'];
                $new_specie = new Profile($id, $name, $gender, $breed, $specie_id, $admittance_date);
                array_push($species, $new_specie);
            }
            return $species;
        }
    }
?>
