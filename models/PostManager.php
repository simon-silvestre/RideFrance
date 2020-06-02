<?php 

namespace Models;

class PostManager extends Config
{
    public function  ShowSkatePark()
    {
        $db = $this->dbConnect();
        $skateparks = $db->query('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks ORDER BY creation_date');
        
        return $skateparks;
    }

    public function  showLastSkatepark()
    {
        $db = $this->dbConnect();
        $LastSkateparks = $db->query('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks ORDER BY creation_date  DESC LIMIT 3');
        
        return $LastSkateparks;
    }

    public function  GetSkatePark($postId)
    {
        $db = $this->dbConnect();
        $PostSkateparks = $db->prepare('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks WHERE id = ?');
        $PostSkateparks->execute(array($postId));
        $skateparkPage = $PostSkateparks->fetch();

        return $skateparkPage;
    }

    public function addSkatepark($region, $ville, $contenu, $image, $adresse)
    {
        $db = $this->dbConnect();
        $PostSkateparks = $db->prepare("INSERT INTO skateParks(id, region, ville, contenu, image, adresse, creation_date) VALUES(NULL, ?, ?, ?, ?, ?, NOW())");
        $PostSkateparks->execute(array($region, $ville, $contenu, $image, $adresse));

        return $PostSkateparks;
    }

    public function supprimerSkatepark($id)
    {
        $db = $this->dbConnect();
        $delChapitre = $db->prepare("DELETE FROM skateParks WHERE id= ? ");
        $delChapitre->execute(array($id));

        return $delChapitre;
    }
}
