<?php
require 'C:/xampp/htdocs/dashboard/quizznourane/config.php';

$question = null; // Initialize variable to store the result

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idq']) && !empty($_GET['idq'])) {
    try {
        // Database connection
        $pdo = Config::getConnexion();

        // Get the `idq` parameter
        $idq = (int)$_GET['idq'];

        // Fetch the question with the given ID
        $sql = "SELECT * FROM question WHERE idq = :idq";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idq', $idq, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            die("Database query failed: " . implode(", ", $stmt->errorInfo()));
        }

        $question = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    } catch (Exception $e) {
        die("General Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Question</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Search Questions by ID</h2>

        <!-- Search Form -->
        <form action="" method="GET" class="mb-4">
            <div class="form-group">
                <label for="searchInput">Enter Question ID:</label>
                <input 
                    type="number" 
                    id="searchInput" 
                    name="idq" 
                    class="form-control" 
                    placeholder="Search by Question ID..." 
                    required
                >
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Display Results -->
        <?php if ($question): ?>
            <h3>Search Results</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($question['idq']); ?></td>
                        <td><?= htmlspecialchars($question['question']); ?></td>
                        <td><?= htmlspecialchars($question['typeq']); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idq'])): ?>
            <div class="alert alert-warning">No question found with the provided ID.</div>
        <?php endif; ?>
    </div>
</body>
</html>