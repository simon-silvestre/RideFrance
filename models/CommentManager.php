<?php 

namespace Models;

class CommentManager extends Config
{
    public function showComments($postId)
    {
        $db = $this->dbConnect();
        $SkateParkComments = $db->prepare('SELECT id, User_pseudo, contenu, signaler, DATE_FORMAT(comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM Commentaires WHERE post_id = ? ORDER BY comment_date DESC');
        $SkateParkComments->execute(array($postId));

        return $SkateParkComments;
    }

    public function showAllComments()
    {
        $db = $this->dbConnect();
        $SkateParkComments = $db->query('SELECT id, post_id, User_pseudo, contenu, signaler DATE_FORMAT(comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM Commentaires ORDER BY comment_date');

        return $SkateParkComments;
    }

    public function showNotes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, Note FROM Notes');
        $SkateParkNotes = $req->fetch();
        
        return $SkateParkNotes;
    }

    public function AddComments($post_id, $pseudo, $commentaire)
    {
        $db = $this->dbConnect();
        $PostCommentaire = $db->prepare("INSERT INTO Commentaires(id, post_id, User_pseudo, contenu, signaler, comment_date) VALUES(NULL, ?, ?, ?, '0', NOW())");
        $PostCommentaire->execute(array($post_id, $pseudo, $commentaire));

        return $PostCommentaire;
    }

    public function signalerCommentaire($id)
    {
        $db = $this->dbConnect();
        $signalerCom = $db->prepare('UPDATE Commentaires SET signaler = 1  WHERE id = ?');
        $signalerCom->execute(array($id));

        return $signalerCom;
    }
}