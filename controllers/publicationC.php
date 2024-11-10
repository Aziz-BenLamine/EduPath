<?php
require_once ROOT_DIR . "models/publication.php";

class publicationC {

    public function fetchPublicationsTest() {
        $publications = [
            new Publication(1, "Comment résoudre ce problème de géométrie ?", "Je rencontre des difficultés avec un problème de géométrie et j'aimerais avoir de l'aide pour le résoudre.", "2024-11-01 14:00:00", "Alice", 1),
            new Publication(2, "Quel est le meilleur moyen de réviser les intégrales ?", "Je cherche des conseils sur les meilleures méthodes pour réviser les intégrales efficacement.", "2024-11-10 12:00:00", "Bob", 2),
            new Publication(3, "Pouvez-vous m'aider à comprendre cette formule ?", "Je ne comprends pas bien cette formule mathématique et j'aimerais avoir une explication détaillée.", "2024-09-30 16:45:00", "Charlie", 3),
            new Publication(4, "Une explication détaillée sur les probabilités serait utile !", "Je suis à la recherche d'une explication détaillée sur les probabilités pour mieux comprendre ce concept.", "2024-09-28 17:00:00", "David", 4),
            new Publication(5, "Quel est le lien entre les matrices et l'algèbre linéaire ?", "Je voudrais savoir comment les matrices sont liées à l'algèbre linéaire et leur importance dans ce domaine.", "2023-09-25 18:15:00", "Eve", 5),
            new Publication(6, "Comment aborder les exercices de physique théorique ?", "Je trouve les exercices de physique théorique très difficiles et j'aimerais des conseils pour les aborder.", "2023-09-20 19:30:00", "Frank", 6),
            new Publication(7, "Quel est le processus pour analyser un réseau informatique ?", "Je souhaite comprendre le processus d'analyse d'un réseau informatique et les étapes à suivre.", "2023-08-15 20:45:00", "Grace", 7),
            new Publication(8, "J'ai besoin d'un corrigé pour cet exercice de chimie organique.", "Je suis bloqué sur un exercice de chimie organique et j'ai besoin d'un corrigé pour avancer.", "2023-07-10 21:00:00", "Heidi", 8),
            new Publication(9, "Des conseils pour réviser efficacement en préparation d'un examen ?", "Je cherche des conseils pour réviser efficacement en vue de mes prochains examens.", "2023-04-05 22:15:00", "Ivan", 9),
            new Publication(10, "Est-ce que quelqu'un peut m'expliquer les bases de l'algèbre ?", "Je suis débutant en algèbre et j'aimerais avoir une explication des bases pour bien commencer.", "2022-10-01 23:30:00", "Judy", 10)
        ];

        return $publications;
    }

    public function timeAgo($datetime)
    {
        $time = strtotime($datetime);
        $time = time() - $time;

        $units = [
            'year' => 31536000,
            'month' => 2592000,
            'week' => 604800,
            'day' => 86400,
            'hour' => 3600,
            'minute' => 60,
            'second' => 1,
        ];

        foreach ($units as $unit => $value) {
            if ($time < $value) continue;
            $numberOfUnits = floor($time / $value);
            return $numberOfUnits . ' ' . $unit . (($numberOfUnits > 1) ? 's' : '') . ' ago';
        }

        return 'just now';
    }
}
?>