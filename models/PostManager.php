<?php 

namespace Models;

class PostManager extends Config
{
    public function  ShowRegionPage()
    {
        $db = $this->dbConnect();
        $skateparks = $db->query('SELECT id, region, ville, contenu, image, adresse, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr FROM skateParks ORDER BY creation_date');
        
        return $skateparks;
    }
}
