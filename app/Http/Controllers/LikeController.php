<?php

class LikeController {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    // Funkcija, kas piešķir vērtējumu publikācijai
    public function like($postId, $userId) {
        // Pārbauda, vai lietotājs jau ir novērtējis šo publikāciju
        $query = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId, $userId]);
        
        if ($stmt->rowCount() > 0) {
            return "Jūs jau esat novērtējis šo publikāciju.";
        }

        // Ievieto jaunu ierakstu par like
        $query = "INSERT INTO likes (post_id, user_id) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId, $userId]);

        return "Jūs veiksmīgi novērtējāt publikāciju.";
    }

    // Funkcija, kas noņem vērtējumu publikācijai
    public function unlike($postId, $userId) {
        // Pārbauda, vai lietotājs ir novērtējis šo publikāciju
        $query = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId, $userId]);
        
        if ($stmt->rowCount() === 0) {
            return "Jūs neesat novērtējis šo publikāciju.";
        }

        // Dzēš ierakstu par like
        $query = "DELETE FROM likes WHERE post_id = ? AND user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$postId, $userId]);

        return "Jūs veiksmīgi noņēmāt savu vērtējumu no publikācijas.";
    }
}

// Lietojums
// $db = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
// $likeController = new LikeController($db);

// $response = $likeController->like(1, 123); // Piemērs, kā piešķirt vērtējumu
// echo $response;

// $response = $likeController->unlike(1, 123); // Piemērs, kā noņemt vērtējumu
// echo $response;

?>
