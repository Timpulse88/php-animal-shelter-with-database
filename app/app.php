<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Profile.php";
    require_once __DIR__."/../src/Specie.php";
    date_default_timezone_set('America/Los_Angeles');

    //Add symfony debug component and turn it on.
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    // Initialize application
    $app = new Silex\Application();

    // Set Silex debug mode in $app object
    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=animal_shelter';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        //$all = Specie::getAll();
        //var_dump($all);
        return $app['twig']->render('index.html.twig', array('species' =>  Specie::getAll()));
    });

    // $app->get("/profiles", function() use ($app) {
    //     return $app['twig']->render('profiles.html.twig', array('profiles' => Profile::getAll()));
    // });
    //
    // $app->get("/species/{id}", function($id) use ($app) {
    //     $specie = Specie::find($id);
    //     return $app['twig']->render('specie.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    // });
    //
    // $app->post("/profiles", function() use ($app) {
    //     $description = $_POST['description'];
    //     $specie_id = $_POST['specie_id'];
    //     $due_date = $_POST['due_date'];
    //     $profile = new Profile($description, $id = null, $specie_id, $due_date);
    //     $profile->save();
    //     $specie = Specie::find($specie_id);
    //     return $app['twig']->render('specie.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    // });
    //
    // $app->post("/delete_profiles", function() use ($app) {
    //     Profile::deleteAll();
    //     return $app['twig']->render('index.html.twig');
    // });
    //
    // $app->post("/species", function() use ($app) {
    //     $specie = new Specie($_POST['name']);
    //     $specie->save();
    //     return $app['twig']->render('index.html.twig', array('species' => Specie::getAll()));
    // });
    //
    // $app->post("/delete_species", function() use ($app) {
    //     Specie::deleteAll();
    //     return $app['twig']->render('index.html.twig');
    // });

    return $app;
?>
