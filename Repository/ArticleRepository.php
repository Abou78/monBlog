<?php

namespace Repository;

use Models\Connection;
use Models\Article;
use PDO;

class ArticleRepository extends Connection {
    public function article(Article $article){
        $db = $this->getConnection();
        $req = '
        INSERT INTO article (title, chapo, content, date_creation, id_user)
        values (:title, :chapo, :content, :dateCreation, :idUser)
        ';
        $stmt = $db->prepare($req);
        $stmt->bindValue(":title",$article->getTitle(),PDO::PARAM_STR);
        $stmt->bindValue(":chapo",$article->getChapo(),PDO::PARAM_STR);
        $stmt->bindValue(":content",$article->getContent(),PDO::PARAM_STR);
        $stmt->bindValue(":dateCreation",$article->getDateCreation()->format('Y-m-d'),PDO::PARAM_STR);
        $stmt->bindValue(":idUser",'1',PDO::PARAM_STR);

        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat >0) return true;
        else return false;
    }
}