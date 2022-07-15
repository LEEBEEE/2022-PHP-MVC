<?php
namespace application\models;
use PDO;

class BoardModel extends Model {
    public function insBoard(&$param) {
        $sql = 
        "INSERT INTO t_board
        (title, ctnt, i_user)
        VALUES
        (:title, :ctnt, :i_user)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->bindValue(':i_user', $param["i_user"]);
        $stmt->execute();
    }
    public function selBoardList() {
        $sql = "SELECT i_board, title, create_at
                FROM t_board
                ORDER BY i_board DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        // prepared statement
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function selBoard(&$param) {
        $sql = 
        "SELECT title, ctnt, A.create_at, A.update_at, A.i_user,
                B.nm
        FROM t_board as A
        INNER JOIN t_user as B
              ON A.i_user = B.i_user
        WHERE i_board = :i_board
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updBoard(&$param) {
        $sql = 
        "UPDATE t_board 
        SET title = :title,
        ctnt = :ctnt,
        update_at = NOW()
        WHERE i_board = :i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $param["title"]);
        $stmt->bindValue(':ctnt', $param["ctnt"]);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();
    }
    
    public function delBoard(&$param) {
        $sql = "DELETE FROM t_board WHERE i_board = :i_board";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':i_board', $param["i_board"]);
        $stmt->execute();
    }
}