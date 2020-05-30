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
        $PostSkateparks = $db->prepare('SELECT region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks WHERE id = ?');
        $PostSkateparks->execute(array($postId));
        $skateparkPage = $PostSkateparks->fetch();

        return $skateparkPage;
    }
}
