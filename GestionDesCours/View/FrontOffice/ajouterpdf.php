<?php
require_once '../../Controller/courscontroller.php';
require_once '../../Controller/categoriescontroller.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $coursController = new CoursController();
    $currentcours = $coursController->getCoursById($id);
}
if (isset($_GET['idcat'])) {
    $idcat = $_GET['idcat'];
    $CategoriesController = new CategoriesController();
    $currentCategory = $CategoriesController->getCategoriesById($idcat);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload PDF</title>
    <link rel="stylesheet" href="t.css">
</head>
<body>
    <h2>Upload PDF File</h2>
    <form  class="form-container" action="upload.php?id=<?php echo $currentcours['id']?>&idcat=<?php echo $currentcours['categorie'] ?>" method="post" enctype="multipart/form-data" style="display: block;">
        <label for="pdfFile">Select PDF file to upload:</label>
        <p>Description du cours</p>
        <input type="file" name="desc" id="desc" accept="application/pdf">
        <p>Cours</p>
        <input type="file" name="File" id="File" accept="application/pdf">
        <input type="text" id="courseid" name="courseid" value="<?php echo $currentcours['id']?>" readonly>
        <button type="submit" class="blue-button" >Upload PDF</button>
    </form>
</body>
</html>