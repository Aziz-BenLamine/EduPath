<?php
require_once '../../Controller/categoriescontroller.php';
require_once '../../Controller/courscontroller.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['query'])) {
    echo json_encode(['reply' => "Aucune donnée reçue."]);
    exit;
}

$query = strtolower(trim($input['query']));
$response = "Désolé, je n'ai pas compris votre demande.";

$categoriesController = new CategoriesController();
$coursController = new CoursController();

function getCategoriesResponse($query, $categoriesController) {
    $categories = $categoriesController->getAllCategories();
    foreach ($categories as $category){
        if (strpos($query, $category['titre']) !== false){
            $filteredCategories= $categoriesController->searchcategories($category['titre']);
        }
    }
    error_log("Query: " . $query);
    error_log("Categories: " . print_r($categories, true));

    
    if (!empty($filteredCategories)) {
        $response = "Voici quelques catégories de cours disponibles correspondant à votre demande : ";
        foreach ($filteredCategories as $categorie) {
            $response .= "{$categorie['titre']}, ";
        }
        return rtrim($response, ", ") . ".";
    } else {
        return "Aucune catégorie de cours ne correspond à votre demande.";
    }
}

function getCoursResponse($query, $coursController) {
    $cours = $coursController->getAllCours();
    error_log("Query: " . $query);
    error_log("Cours: " . print_r($cours, true));

    $filteredCours = [];
    foreach ($cours as $cour) {
        if (stripos(strtolower(trim($cour['titre'])), $query) !== false) {
            $filteredCours[] = $cour;
        }
    }

    if (!empty($filteredCours)) {
        $response = "Voici quelques cours disponibles correspondant à votre demande : ";
        foreach ($filteredCours as $cour) {
            $response .= "{$cour['titre']}, ";
        }
        return rtrim($response, ", ") . ".";
    } else {
        return "Aucun cours ne correspond à votre demande.";
    }
}

switch (true) {
    case strpos($query, 'cours') !== false:
        $response = getCoursResponse($query, $coursController);
        break;

    case strpos($query, 'categorie') !== false:
        $response = getCategoriesResponse($query, $categoriesController);
        break;

    case strpos($query, 'recommandation') !== false || strpos($query, 'besoin') !== false:
        $response = "Je peux vous aider à trouver des cours adaptés. Dites-moi vos intérêts.";
        break;

    case strpos($query, 'bonjour') !== false || strpos($query, 'salut') !== false:
        $response = "Bonjour! Comment puis-je vous aider aujourd'hui?";
        break;

    case strpos($query, 'merci') !== false:
        $response = "De rien! N'hésitez pas si vous avez d'autres questions.";
        break;

    case strpos($query, 'aide') !== false:
        $response = "Je suis là pour vous aider. Vous pouvez me poser des questions sur les cours, les catégories, ou demander des recommandations.";
        break;

    default:
        $response = "Désolé, je n'ai pas compris votre demande. Pouvez-vous reformuler?";
        break;
}

echo json_encode(['reply' => $response]);
exit;
