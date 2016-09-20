<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Profile.php";
    require_once "src/Specie.php";

    $server = 'mysql:host=localhost;dbname=animal_shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class ProfileTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Profile::deleteAll();
            Specie::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $name = "Fido";
            $id = null;
            $test_profile = new Profile($id, $name, "male", "german shepard", "dog", "09");
            $test_profile->save();
            $profile_id = $test_profile->getId();
            //Act
            $result = $test_profile->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getSpecieId()
        {
            //Arrange
            $type = "Dog";
            $id = null;
            $test_specie = new Specie($id, $type);
            $test_specie->save();
            $specie_id = $test_specie->getId();
            $test_profile = new Profile($id, "bob", "male", "german shepard", $specie_id, "09");
            $test_profile->save();

            //Act
            $result = $test_profile->getSpecieId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        //
        // function test_save()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_specie = new Specie($name, $id);
        //     $test_specie->save();
        //
        //     $description = "Wash the dog";
        //     $specie_id = $test_specie->getId();
        //     $test_task = new Profile($description, $id, $specie_id);
        //
        //     //Act
        //     $test_task->save();
        //
        //     //Assert
        //     $result = Profile::getAll();
        //     $this->assertEquals($test_task, $result[0]);
        // }
        //
        // function test_getAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_specie = new Specie($name, $id);
        //     $test_specie->save();
        //
        //     $description = "Wash the dog";
        //     $specie_id = $test_specie->getId();
        //     $test_task = new Profile($description, $id, $specie_id);
        //     $test_task->save();
        //
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Profile($description2, $id, $specie_id);
        //     $test_task2->save();
        //
        //     //Act
        //     $result = Profile::getAll();
        //
        //     //Assert
        //     $this->assertEquals([$test_task, $test_task2], $result);
        // }
        //
        // function test_deleteAll()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_specie = new Specie($name, $id);
        //     $test_specie->save();
        //
        //     $description = "Wash the dog";
        //     $specie_id = $test_specie->getId();
        //     $test_task = new Profile($description, $id, $specie_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Profile($description2, $id, $specie_id);
        //     $test_task2->save();
        //
        //     //Act
        //     Profile::deleteAll();
        //
        //     //Assert
        //     $result = Profile::getAll();
        //     $this->assertEquals([], $result);
        // }
        //
        // function test_find()
        // {
        //     //Arrange
        //     $name = "Home stuff";
        //     $id = null;
        //     $test_specie = new Specie($name, $id);
        //     $test_specie->save();
        //
        //     $description = "Wash the dog";
        //     $specie_id = $test_specie->getId();
        //     $test_task = new Profile($description, $id, $specie_id);
        //     $test_task->save();
        //
        //     $description2 = "Water the lawn";
        //     $test_task2 = new Profile($description2, $id, $specie_id);
        //     $test_task2->save();
        //
        //     //Act
        //     $result = Profile::find($test_task->getId());
        //
        //     //Assert
        //     $this->assertEquals($test_task, $result);
        // }

    }
?>
