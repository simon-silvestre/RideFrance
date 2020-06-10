<?php 

namespace Models;

class CommentManager extends Config
{
    public function showComments($postId)
    {
        $db = $this->dbConnect();
        $SkateParkComments = $db->prepare('SELECT u.*, c.id, c.post_id, c.User_pseudo, c.Notes, c.contenu, c.signaler, DATE_FORMAT(c.comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM commentaires c INNER JOIN Users u ON c.User_pseudo = u.pseudo WHERE c.post_id = ?');
        $SkateParkComments->execute(array($postId));

        return $SkateParkComments;
    }

    public function showAllComments()
    {
        $db = $this->dbConnect();
        $SkateParkComments = $db->query('SELECT u.*, c.id, c.post_id, c.User_pseudo, c.Notes, c.contenu, c.signaler, DATE_FORMAT(c.comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM commentaires c INNER JOIN Users u ON c.User_pseudo = u.pseudo ORDER BY signaler DESC, comment_date DESC');

        return $SkateParkComments;
    }

    public function AddComments($post_id, $pseudo, $note, $commentaire)
    {
        $db = $this->dbConnect();
        $PostCommentaire = $db->prepare("INSERT INTO Commentaires(id, post_id, User_pseudo, Notes, contenu, signaler, comment_date) VALUES(NULL, ?, ?, ?, ?, '0', NOW())");
        $PostCommentaire->execute(array($post_id, $pseudo, $note, $commentaire));

        return $PostCommentaire;
    }

    public function signalerCommentaire($id)
    {
        $db = $this->dbConnect();
        $signalerCom = $db->prepare('UPDATE Commentaires SET signaler = 1  WHERE id = ?');
        $signalerCom->execute(array($id));

        return $signalerCom;
    }
    

    public function deleteCommentaire($id)
    {
        $db = $this->dbConnect();
        $delCommentaire = $db->prepare("DELETE FROM commentaires WHERE id= ?");
        $delCommentaire->execute(array($id));

        return $delCommentaire;
    }

    public function ApprouverCommentaires($id)
    {
        $db = $this->dbConnect();
        $signalerCom = $db->prepare('UPDATE Commentaires SET signaler = 0  WHERE id = ?');
        $signalerCom->execute(array($id));

        return $signalerCom;
    }

    public function getAvgRating($postId)
    {
        $db = $this->dbConnect();
        $notesMoyenne = $db->prepare('SELECT avg(Notes) as avg FROM Commentaires  WHERE post_id = ?');
        $notesMoyenne->execute(array($postId));
        $Moyenne = $notesMoyenne->fetch();

        return $Moyenne;
    }
}