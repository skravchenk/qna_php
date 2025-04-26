<?php
namespace App;

require_once 'Database.php';

use PDO;
use PDOException;

class QnA extends Database {

    public function getAllQnA() {
        try {
            $sql = "SELECT question, answer FROM qna";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching QnA: " . $e->getMessage());
            return [];
        }
    }

    public function insertQnA($question, $answer) {
        try {
            $conn = $this->getConnection();

            $checkSql = "SELECT COUNT(*) FROM qna WHERE question = :question AND answer = :answer";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->execute([
                ':question' => $question,
                ':answer' => $answer
            ]);

            if ($checkStmt->fetchColumn() > 0) {
                return false;
            }

            $insertSql = "INSERT INTO qna (question, answer) VALUES (:question, :answer)";
            $insertStmt = $conn->prepare($insertSql);
            return $insertStmt->execute([
                ':question' => $question,
                ':answer' => $answer
            ]);
        } catch (PDOException $e) {
            error_log("Error inserting QnA: " . $e->getMessage());
            return false;
        }
    }
}
?>
