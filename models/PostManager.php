<?php 

namespace Models;

class PostManager extends Config
{
    public function  ShowRegionSkatePark($region)
    {
        $db = $this->dbConnect();
        $skateparksRegion = $db->prepare('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks WHERE region = ? AND User = 0 ORDER BY creation_date');
        $skateparksRegion->execute(array($region));

        return $skateparksRegion;
    }

    public function  ShowAllSkatePark()
    {
        $db = $this->dbConnect();
        $skateparks = $db->query('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr, User FROM skateParks ORDER BY creation_date');
        
        return $skateparks;
    }

    public function  showLastSkatepark()
    {
        $db = $this->dbConnect();
        $LastSkateparks = $db->query('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr FROM skateParks  WHERE User = 0 ORDER BY creation_date  DESC LIMIT 3');
        
        return $LastSkateparks;
    }

    public function  GetSkatePark($postId)
    {
        $db = $this->dbConnect();
        $PostSkateparks = $db->prepare('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%M/%Y\') AS creation_date_fr, User FROM skateParks WHERE id = ?');
        $PostSkateparks->execute(array($postId));
        $skateparkPage = $PostSkateparks->fetch();

        return $skateparkPage;
    }

    public function Favoris($post_id, $user_id)
    {
        $db = $this->dbConnect();
        $Favoris = $db->prepare("INSERT INTO Favoris(post_id, user_id) VALUES(?, ?)");
        $Favoris->execute(array($post_id, $user_id));

        return $Favoris;
    }

    public function GetFavoris($userId)
    {
        $db = $this->dbConnect();
        $Favoris = $db->prepare('SELECT s.id, s.region, s.ville, s.contenu, s.image, s.adresse, DATE_FORMAT(s.creation_date, \'%d/%M/%Y\') AS creation_date_fr, s.User, f.post_id, f.user_id FROM Favoris f INNER JOIN skateParks s ON f.post_id = s.id WHERE f.user_id = ?');
        $Favoris->execute(array($userId));

        return $Favoris;
    }

    public function addSkatepark($region, $ville, $contenu, $image, $adresse)
    {
        $db = $this->dbConnect();
        $PostSkateparks = $db->prepare("INSERT INTO skateParks(id, region, ville, contenu, image, adresse, creation_date, User) VALUES(NULL, ?, ?, ?, ?, ?, NOW(), 0)");
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

    public function updateSkatepark($id, $region, $ville, $contenu, $image, $adresse)
    {
        $db = $this->dbConnect();
        $up = $db->prepare("UPDATE skateParks SET region= ?, Ville = ?, contenu = ?, image= ?, adresse = ?  WHERE id = ?");
        $update = $up->execute(array($region, $ville, $contenu, $image, $adresse, $id));

        return $update;
    }

    public function UserSkatepark($region, $ville, $contenu, $image, $adresse)
    {
        $db = $this->dbConnect();
        $PostSkateparks = $db->prepare("INSERT INTO skateParks(id, region, ville, contenu, image, adresse, creation_date, User) VALUES(NULL, ?, ?, ?, ?, ?, NOW(), 1)");
        $PostSkateparks->execute(array($region, $ville, $contenu, $image, $adresse));

        return $PostSkateparks;
    }

    public function valideSkatepark($id)
    {
        $db = $this->dbConnect();
        $valide = $db->prepare("UPDATE skateParks SET User = 0 WHERE id = ?");
        $valide->execute(array($id));

        return $valide;
    }
}
