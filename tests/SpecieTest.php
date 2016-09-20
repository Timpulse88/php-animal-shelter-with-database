<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Specie.php";
    require_once "src/Profile.php";

    $server = 'mysql:host=localhost;dbname=animal_shelter_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class SpecieTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
          Profile::deleteAll();
          Specie::deleteAll();
        }

        function test_getType()
        {
            //Arrange
            $type = "Dog";
            $test_Specie = new Specie(null, $type);

            //Act
            $result = $test_Specie->getType();

            //Assert
            $this->assertEquals($type, $result);
        }
    //
    //     function test_getId()
    //     {
    //         //Arrange
    //         $name = "Work stuff";
    //         $id = 1;
    //         $test_Specie = new Category($name, $id);
    //
    //         //Act
    //         $result = $test_Category->getId();
    //
    //         //Assert
    //         $this->assertEquals(true, is_numeric($result));
    //     }
    //
    //     function test_save()
    //     {
    //         //Arrange
    //         $name = "Work stuff";
    //         $test_Category = new Category($name);
    //         $test_Category->save();
    //
    //         //Act
    //         $result = Category::getAll();
    //
    //         //Assert
    //         $this->assertEquals($test_Category, $result[0]);
    //     }
    //
        function test_getAll()
        {
            //Arrange
            $type = "dog";
            $type2 = "cat";
            $test_Specie = new Specie("2", $type);
            $test_Specie->save();
            // $test_Specie2 = new Specie(3, $type2);
            // $test_Specie2->save();

            //Act
            $result = Specie::getAll();

            //Assert
            $this->assertEquals([$test_Specie], $result);
        }
    //
    //     function test_deleteAll()
    //     {
    //         //Arrange
    //         $name = "Wash the dog";
    //         $name2 = "Home stuff";
    //         $test_Category = new Category($name);
    //         $test_Category->save();
    //         $test_Category2 = new Category($name2);
    //         $test_Category2->save();
    //
    //         //Act
    //         Category::deleteAll();
    //         $result = Category::getAll();
    //
    //         //Assert
    //         $this->assertEquals([], $result);
    //     }
    //
    //     function test_find()
    //     {
    //         //Arrange
    //         $name = "Wash the dog";
    //         $name2 = "Home stuff";
    //         $test_Category = new Category($name);
    //         $test_Category->save();
    //         $test_Category2 = new Category($name2);
    //         $test_Category2->save();
    //
    //         //Act
    //         $result = Category::find($test_Category->getId());
    //
    //         //Assert
    //         $this->assertEquals($test_Category, $result);
    //     }
    //
    //     function testGetTasks()
    //     {
    //         //Arrange
    //         $name = "Work stuff";
    //         $id = null;
    //         $test_category = new Category($name, $id);
    //         $test_category->save();
    //
    //         $test_category_id = $test_category->getId();
    //
    //         $description = "Email client";
    //         $test_task = new Task($description, $id, $test_category_id);
    //         $test_task->save();
    //
    //         $description2 = "Meet with boss";
    //         $test_task2 = new Task($description2, $id, $test_category_id);
    //         $test_task2->save();
    //
    //         //Act
    //         $result = $test_category->getTasks();
    //
    //         //Assert
    //         $this->assertEquals([$test_task, $test_task2], $result);
    //     }
    // }
}
?>
