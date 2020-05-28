<?php 

namespace Models;

class CommentManager extends Config
{
    public function showComments()
    {
        $db = $this->dbConnect();
        $SkateParkComments = $db->query('SELECT id, post_id, User_pseudo, contenu, DATE_FORMAT(comment_date, \'%d/%M/%Y\') AS comment_date_fr FROM Commentaires ORDER BY comment_date');
        
        return $SkateParkComments;
    }

    public function showNotes()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, post_id, Note FROM Notes');
        $SkateParkNotes = $req->fetch();
        
        return $SkateParkNotes;
    }
}