<?php
include_once ROOT_DIR . 'models/reponse.php';

class reponseC
{
    public function fetchReponsesTest()
    {
        $reponses = [
            new reponse(1, "Pour résoudre ce problème de géométrie, commencez par identifier les angles et les côtés connus. Ensuite, utilisez le théorème de Pythagore pour trouver les longueurs manquantes.", "2024-11-01 14:00:00", "Alice", 1),
            new reponse(2, "Le meilleur moyen de réviser les intégrales est de pratiquer régulièrement. Utilisez des exercices variés pour couvrir tous les types d'intégrales.", "2024-11-10 12:00:00", "Bob", 1),
            new reponse(3, "Pour comprendre cette formule, décomposez-la en parties plus petites et analysez chaque terme individuellement. Cela vous aidera à voir comment ils se combinent pour former la formule complète.", "2024-09-30 16:45:00", "Charlie", 1),
            new reponse(4, "Pour une explication détaillée sur les probabilités, commencez par les concepts de base comme les événements et les probabilités conditionnelles. Ensuite, explorez les distributions de probabilité et les théorèmes importants.", "2024-09-28 17:00:00", "David", 1),
            new reponse(5, "Les matrices sont un outil fondamental en algèbre linéaire. Elles permettent de représenter et de manipuler des systèmes d'équations linéaires, des transformations linéaires et des espaces vectoriels.", "2023-09-25 18:15:00", "Eve", 1),
            new reponse(6, "Pour aborder les exercices de physique théorique, commencez par bien comprendre les concepts théoriques. Ensuite, appliquez ces concepts à des problèmes pratiques en utilisant des méthodes de résolution systématiques.", "2023-09-20 19:30:00", "Frank", 1),
            new reponse(7, "Pour analyser un réseau informatique, commencez par cartographier le réseau et identifier tous les appareils connectés. Ensuite, utilisez des outils de surveillance pour analyser le trafic et détecter les anomalies.", "2023-08-15 20:45:00", "Grace", 1),
            new reponse(8, "Pour cet exercice de chimie organique, commencez par identifier les groupes fonctionnels et les réactions possibles. Ensuite, utilisez des mécanismes de réaction pour prédire les produits.", "2023-07-10 21:00:00", "Heidi", 1),
            new reponse(9, "Pour réviser efficacement en préparation d'un examen, créez un plan de révision détaillé et utilisez des techniques de mémorisation active comme les flashcards et les quiz.", "2023-04-05 22:15:00", "Ivan", 1),
            new reponse(10, "Pour comprendre les bases de l'algèbre, commencez par les opérations fondamentales comme l'addition, la soustraction, la multiplication et la division. Ensuite, explorez les équations et les inégalités.", "2022-10-01 23:30:00", "Judy", 1)
        ];


        return $reponses;
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