<?php
require_once "/xampp/htdocs/EduPath/models/publication.php";
require_once "/xampp/htdocs/EduPath/config.php";
require_once "/xampp/htdocs/EduPath/loadEnv.php";
loadEnv();

class publicationC
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnexion();
    }

    public function creePar($id)
    {
        $stmt = $this->pdo->prepare("SELECT username FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function publicationTable()
    {
        $stmt = $this->pdo->query("SELECT * FROM publication");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //CRUD
    public function listPublications($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM publication WHERE sujet = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPublication($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM publication WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function addPublication($publication)
    {
        $stmt = $this->pdo->prepare("INSERT INTO publication (titre, contenu, date_creation, cree_par, sujet) VALUES (:titre, :contenu, :date_creation, :cree_par, :sujet)");
        $stmt->execute($publication);
    }

    public function deletePublication($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM publication WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function updatePublication($data)
    {
        $sql = "UPDATE publication SET titre = :titre, contenu = :contenu WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titre' => $data['title'],
            ':contenu' => $data['description'],
            ':id' => $data['id']
        ]);
    }

    //API


    //REPONSE MODEL GEMINI
    public function getGeminiResponse($inputText)
    {
        $apiKey = getenv('GEMINI_API_KEY');
        $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent?key=' . $apiKey;

        $data = [
            'contents' => [
                [
                    'parts' => [
                        ['text' => "Répondez brièvement à cette question : " . $inputText]
                    ]
                ]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('cURL error: ' . curl_error($ch));
            curl_close($ch);
            return 'Error during API request: ' . curl_error($ch);
        }

        curl_close($ch);

        // Log the raw response for debugging
        error_log('Raw response: ' . $response);

        $responseData = json_decode($response, true);

        if (!$responseData) {
            error_log('JSON decode error: ' . json_last_error_msg());
            return 'Error decoding API response.';
        }

        // Check for the response text in the new format
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            $responseText = $responseData['candidates'][0]['content']['parts'][0]['text'];
            return $this->formatResponseText($responseText);
        } elseif (isset($responseData['error'])) {
            return "Error from API: " . $responseData['error']['message'];
        } else {
            return "Unexpected response format: " . print_r($responseData, true);
        }
    }

    // CONVERTING MARKDOWN TO HTML
    private function formatResponseText($text)
    {

        $text = preg_replace('/\*\*(.*?)\*\*/', '<b>$1</b>', $text);  // For bold text
        $text = preg_replace('/\* (.*?)\n/', '<ul><li>$1</li></ul>', $text); // For bullet points
        $text = preg_replace('/\|/', '<table>', $text); // Table start (simplified for demonstration)
        $text = preg_replace('/\n/', '<br>', $text);  // Line breaks

        return $text;
    }

    //STATS
    public function countPublications()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM publication");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
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
