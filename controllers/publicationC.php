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
    function getEducationalArticles($query)
    {
        $apiKey = getenv('GEMINI_API_KEY');
        $cx = '952da862c54e94b95';
        $apiUrl = "https://www.googleapis.com/customsearch/v1?q=" . urlencode($query) . "&cx={$cx}&key={$apiKey}&hl=fr";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    //REPONSE MODEL FLAN-T5-LARGE
    public function getAIResponse($taskDescription, $inputText)
    {
        $apiKey = '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';
        $apiUrl = 'https://api-inference.huggingface.co/models/google/flan-t5-large';

        // Combine task description with input text
        $data = [
            'inputs' => $taskDescription . ': ' . $inputText,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: ' . 'Bearer ' . $apiKey,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('CURL Error: ' . curl_error($ch));
            return "Error: Unable to process request.";
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        // Debugging
        error_log(print_r($responseData, true));

        // Adapt response handling
        if (isset($responseData[0]['generated_text'])) {
            return $responseData[0]['generated_text'];
        } else if (isset($responseData['error'])) {
            return "Error from API: " . $responseData['error'];
        } else {
            return "No response generated or unexpected format.";
        }
    }

    //REPONSE MODEL GEMINI
    public function getGeminiResponse($inputText)
    {
        $apiKey = 'AIzaSyAMeXID9ChaQKb-TsAyDPOcVD7CyuByZ_c';
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
