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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        //$all = Specie::getAll();
        //var_dump($all);

        return $app['twig']->render('index.html.twig', array('species' =>  Specie::getAll()));
    });
    $app->post("/species", function() use ($app) {
        // Profile::deleteAll();
        // Specie::deleteAll();
        $specie = new Specie(null, $_POST['specie']);
        $specie->save();
        return $app['twig']->render('index.html.twig', array('species' => Specie::getAll()));
    });
    $app->get("/species/{id}", function($id) use ($app) {
        $specie = Specie::find($id);
        return $app['twig']->render('species.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    });

    $app->post("/profiles", function() use ($app) {
        $name = $_POST['name'];
        $specie_id = $_POST['specie_id'];
        $gender = $_POST['gender'];
        $admittance_date = $_POST['admittance_date'];
        $breed = $_POST['breed'];
        $url = $_POST['url'];
        $profile = new Profile(null, $name, $gender, $breed, $specie_id, $admittance_date, $url);
        $profile->save();
        $specie = Specie::find($specie_id);
        //var_dump($specie);
        return $app['twig']->render('species.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    });
    $app->get("/species/{id}/edit", function($id) use ($app) {
        $specie = Specie::find($id);
        return $app['twig']->render('edit.html.twig', array('specie' => $specie));
    });

    $app->patch("/species/{id}", function($id) use ($app) {
        $name = $_POST['name'];
        $specie = Specie::find($id);
        $specie->update($name);
        return $app['twig']->render('species.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    });

    $app->patch("/profile/{id}", function($id) use ($app) {
        $profile = Profile::find($id);
        $specie = Specie::find($id);
        $profile->update();
        return $app['twig']->render('species.html.twig', array('specie' => $specie, 'profiles' => $specie->getProfiles()));
    });
    $app->delete("/species/{id}", function($id) use ($app) {
        $species = Specie::find($id);
        $species->delete();
        return $app['twig']->render('index.html.twig', array('species' => Specie::getAll()));
    });

    return $app;
?>
