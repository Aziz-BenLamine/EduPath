<?php
require_once '../../Controller/courscontroller.php';


    $cours= new Cours(
        1,
        $_POST['courseTitle'],
        $_POST['courseDescription'],
        $_POST['courseLevel'],
        $_POST['coursePrice'],
        $_POST['courseCategory']
    );

    $courseController = new CoursController();
    $courseController->ajoutercours($cours);
    header('Location: courstuteur.php?id='.$_POST['courseCategory']);
?>
