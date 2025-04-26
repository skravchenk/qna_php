<?php

class QnA {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllQnA() {
        $sql = "SELECT question, answer FROM qna";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertQnA($question, $answer) {
        $checkSql = "SELECT COUNT(*) FROM qna WHERE question = :question AND answer = :answer";
        $checkStmt = $this->conn->prepare($checkSql);
        $checkStmt->execute([
            ':question' => $question,
            ':answer' => $answer
        ]);

        if ($checkStmt->fetchColumn() > 0) {
            return false;
        }

        $insertSql = "INSERT INTO qna (question, answer) VALUES (:question, :answer)";
        $insertStmt = $this->conn->prepare($insertSql);
        return $insertStmt->execute([
            ':question' => $question,
            ':answer' => $answer
        ]);
    }

    /*
    public function insertOldQnA($question, $answer) {
        $sql = "INSERT INTO qna (question, answer) VALUES (:question, :answer)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':question' => $question,
            ':answer' => $answer
        ]);
    }
    */
}
?>
