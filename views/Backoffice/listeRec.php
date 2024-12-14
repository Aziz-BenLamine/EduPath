<?php
include '../../controllers/réclamationC.php';

$reclamationController = new ReclamationC();
$listeReclamations = $reclamationController->listeReclamations();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réclamations</title>
    <script src="hide.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff; /* Bleu clair */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #b3d9ff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%; /* Réduire la largeur de la table */
            max-width: 1000px;
            margin: 20px auto;
        }

        h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #0056b3; /* Bleu foncé */
            color: white;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .actions {
            width: 200px; /* Réduire la largeur de la colonne des actions */
        }

        .actions a {
            display: inline-block;
            padding: 5px 10px; /* Réduire la taille du bouton */
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            background-color: #0056b3; /* Bleu foncé */
        }

        .actions a:hover {
            background-color: #004494; /* Bleu encore plus foncé au survol */
        }
        .sort-btn {
            background-color: #0056b3; /* Bleu foncé */
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .sort-btn:hover {
            background-color: #004494; /* Bleu encore plus foncé au survol */
        }
        .sort-options {
    position: absolute;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    margin-top: 10px;
    z-index: 1000;
}

.sort-option-btn {
    background-color: #0056b3; /* Bleu foncé */
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    width: 100%;
    text-align: left;
}

.sort-option-btn:hover {
    background-color: #004494; /* Bleu encore plus foncé au survol */
}
.search-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-container label {
            margin-right: 10px;
            font-size: 16px;
            color: #333;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #b3d9ff; /* Bordure bleu clair */
            border-radius: 4px;
            width: 200px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        .search-container input[type="text"]:focus {
            border-color: #0056b3; /* Bordure bleu foncé au focus */
            outline: none;
        }

        .search-container img {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }
        .select-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .select-container label {
            margin-right: 10px;
            font-size: 16px;
            color: #333;
        }

        .select-container select {
            padding: 10px;
            border: 1px solid #b3d9ff; /* Bordure bleu clair */
            border-radius: 4px;
            box-sizing: border-box;
        }

        .select-container select:focus {
            border-color: #0056b3; /* Bordure bleu foncé au focus */
            outline: none;
        }
    </style>
     <script>
        document.addEventListener("DOMContentLoaded", function() {
        const sortBtn = document.getElementById('sortBtn');
        const sortOptions = document.getElementById('sortOptions');
        const sortDateBtn = document.getElementById('sortDateBtn');
        const sortNameBtn = document.getElementById('sortNameBtn');
        const defaultSortBtn = document.getElementById('defaultSortBtn');
        const searchBtn = document.getElementById('searchBtn');
        const searchInput = document.getElementById('searchInput');
        const table = document.querySelector('table tbody');
        const rows = Array.from(table.querySelectorAll('tr'));
        const originalOrder = [...rows];
        sortBtn.addEventListener('click', function() {
            sortOptions.style.display = sortOptions.style.display === 'none' ? 'block' : 'none';
        });
        sortDateBtn.addEventListener('click', function() {
            rows.sort((a, b) => {
                const dateA = new Date(a.cells[2].innerText);
                const dateB = new Date(b.cells[2].innerText);
                return dateB - dateA; // Trier de la plus récente à la plus ancienne
            });
            rows.forEach(row => table.appendChild(row));
            sortOptions.style.display = 'none';
        });
        sortNameBtn.addEventListener('click', function() {
            rows.sort((a, b) => {
                const nameA = a.cells[1].innerText.toLowerCase();
                const nameB = b.cells[1].innerText.toLowerCase();
                if (nameA < nameB) return -1;
                if (nameA > nameB) return 1;
                return 0;
            });
            rows.forEach(row => table.appendChild(row));
            sortOptions.style.display = 'none';
        });
        defaultSortBtn.addEventListener('click', function() {
            originalOrder.forEach(row => table.appendChild(row));
            sortOptions.style.display = 'none';
        });
        searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const statut = row.cells[4].innerText.toLowerCase();
                    if (statut.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            selectLimit.addEventListener('change', function() {
                const limit = selectLimit.value === 'all' ? rows.length : parseInt(selectLimit.value);
                rows.forEach((row, index) => {
                    if (index < limit) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Initial display based on the default limit
            const defaultLimit = selectLimit.value === 'all' ? rows.length : parseInt(selectLimit.value);
            rows.forEach((row, index) => {
                if (index < defaultLimit) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
    });
    </script>
</head>
<body>
<?php include 'C:\xampp\htdocs\EduPath\views/components/sidebar.php'; ?>
<div class="container">
        <h2>Liste des Réclamations</h2>
        <div class="search-container">
        <label for="searchInput">Rechercher par statut :</label>
            <input type="text" id="searchInput" placeholder="Entrez le statut">
            <img src="search.png" alt="Rechercher" id="searchBtn">
        </div>
        <div class="select-container">
            <label for="selectLimit">Nombre de réclamations à afficher :</label>
            <select id="selectLimit">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="all">Tout</option>
            </select>
        </div>
        <button id="sortBtn" class="sort-btn">Trier</button>
        <div id="sortOptions" class="sort-options" style="display: none;">
            <button id="sortDateBtn" class="sort-option-btn">Trier par date</button>
            <button id="sortNameBtn" class="sort-option-btn">Trier par nom</button>
            <button id="defaultSortBtn" class="sort-option-btn">Ordre par défaut</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Sujet</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listeReclamations as $reclamation) {
                    if ($reclamation['is_visible'] == 1) {
                    echo '<tr>';
                    echo '<td>' . ($reclamation['id']) . '</td>';
                    echo '<td>' . ($reclamation['nom']) . '</td>';
                    echo '<td>' . ($reclamation['date_c']) . '</td>';
                    echo '<td>' . ($reclamation['sujet']) . '</td>';
                    echo '<td>' . ($reclamation['statut']) . '</td>';
                    echo '<td class="actions">';
                    echo '<a href="repondre.php?id=' . ($reclamation['id']) . '" class="btn-action">Répondre</a>';
                    echo '<a href="hide.php?id=' . htmlspecialchars($reclamation['id']) . '" class="btn-action btn-hide">Masquer</a>';
                    echo '</td>';
                    echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>