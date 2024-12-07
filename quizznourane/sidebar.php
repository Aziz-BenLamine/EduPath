<?php
include('../quizznourane/controleur/quizControler.php');

$quizController = new quizs();
$questions = $quizController->affichequestion();



$results = []; // Variable to hold search results
$message = ''; // Variable to hold messages (e.g., no results)

// Check if the search query is provided
if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']); // Sanitize user input

    $controller = new quizs(); // Instantiate the controller
    try {
        // Fetch results using the searchQuestions method
        $results = $controller->searchQuestions($query);

        if (empty($results)) {
            $message = 'No results found for "' . htmlspecialchars($query) . '".';
        }
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="side.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="side.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        .hidden {
            display: none;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        .table-wrapper {
            margin-top: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-bar input {
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .print-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .print-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="sidebar" role="navigation" aria-label="Sidebar">
        <div class="logo">
            <img src="EduPathLogo.png" alt="EduPath Logo" />
            <span>EduPath</span>
        </div>
        <a href="#home" class="active"><i class="fas fa-users"></i> Gestion des utilisateurs</a>
        <a href="#services"><i class="fas fa-book"></i> Gestion des categories et des cours</a>
        <a href="#clients"><i class="fas fa-comments"></i> Gestion du forum</a>
        <a href="#quiz" id="quizLink"><i class="fas fa-question-circle"></i> Gestion des quizs</a>
        <a href="#contact"><i class="fas fa-exclamation-triangle"></i> Gestion des reclamations</a>
    </div>
    <button class="toggle-btn">&#9664;</button>

    <div class="content">
        <h2>Questions List</h2>

                <!-- Search Bar and Print Button -->
                <div class="search-bar">
                

</div>
        <!-- Questions Table -->
        <div class="table-wrapper">
        <table class="table table-bordered table-striped" id="questionsTable">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Type</th>
            <th>ID QUIZ</th>
            <th>Nombre de réponses possibles</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($questions as $question): ?>
            <tr>
                <td><?= htmlspecialchars($question['idq']); ?></td>
                <td><?= htmlspecialchars($question['question']); ?></td>
                <td><?= htmlspecialchars($question['typeq']); ?></td>
                <td><?= htmlspecialchars($question['id_quiz']); ?></td>
                <td><?= htmlspecialchars($question['numR']); ?></td>
                <td>
                    <!-- Update Button -->
                    <form action="update_question.php" method="GET" style="display:inline;">
                    <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                       
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                    
                    <!-- Delete Button -->
                    <form action="delete_question.php" method="POST" style="display:inline;">
                        <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this question?');">Delete</button>
                    </form>
                    <form action="view\ajoutreponse.php" method="GET" style="display:inline;">
                        <input type="hidden" name="idq" value="<?= htmlspecialchars($question['idq']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm" >Add response </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        </div>
        <div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Search Results</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive p-0">
                    <body>
                        <div class="container">
                            <!-- Search Form -->
                            <form action="" method="GET" class="mb-4">
    <div class="form-group">
        <label for="searchInput">Search Questions by Keyword:</label>
        <input 
            type="text" 
            id="searchInput" 
            name="query" 
            class="form-control" 
            placeholder="Enter a keyword..." 
            required
        >
    </div>
    <button type="submit" class="btn btn-primary mt-2">Search</button>
</form>

<!-- Display Results or Message -->
<?php if (!empty($message)): ?>
    <div class="alert alert-info">
        <?= $message ?>
    </div>
<?php endif; ?>

<?php if (!empty($results)): ?>
    <h3>Search Results:</h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>ID QUIZZ</th>
                    <th>Nombre de reponse possible</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?= htmlspecialchars($result['idq']) ?></td>
                        <td><?= htmlspecialchars($result['question']) ?></td>
                        <td><?= htmlspecialchars($result['typeq']) ?></td>
                        <td><?= htmlspecialchars($result['id_quiz']) ?></td>
                        <td><?= htmlspecialchars($result['numR']) ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p class="text-muted">All questions are listed below. Use the search bar above to filter results.</p>
<?php endif; ?>

                        </div>
                    </body>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="search-bar">
    
</div>
<form action="pdf.php"  style="display:inline;">
  <button type="submit" class="btn btn-danger btn-sm" >Imprimer</button>
 </form>
    </div>
    <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Envoi d'email</h6>
                </div>
            </div>
            <div class="card-body">
            <form method="POST" action="test.php">
    <div class="form-group mb-3">
        <label for="adresse" class="form-label">Email Address</label>
        <input 
            type="email" 
            id="adresse" 
            name="adresse" 
            class="form-control form-control-lg" 
            placeholder="Entrez l'email" 
            required
        >
        <div class="error-message" id="emailError"></div>

    </div>

    <!-- Subject -->
    <div class="form-group mb-3">
        <label for="objet" class="form-label">Subject</label>
        <input 
            type="text" 
            id="objet" 
            name="subject" 
            class="form-control form-control-lg" 
            placeholder="Entrez l'objet" 
            required
        >
        <div class="error-message" id="subjectError"></div>

    </div>

    <!-- Message -->
    <div class="form-group mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea 
            id="message" 
            name="message" 
            class="form-control form-control-lg" 
            rows="4" 
            placeholder="Entrez le message" 
            required
        ></textarea>
        <div class="error-message" id="messageError"></div>

    </div>

    <!-- Submit Button -->
    <div class="text-center">
        <button type="submit" name="send" value="submit" class="btn btn-success btn-lg w-100">Envoyer un email</button>
    </div>
</form>
    
</body>
</html>
