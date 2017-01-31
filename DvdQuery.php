<?php
namespace Database\Query;
require './Database.php';

class DvdQuery  extends \Database{

  private $sql;
  public $searchTerm;

  public function titleContains($searchTerm){
    $this->searchTerm = $searchTerm;
    $this->sql = "SELECT  dvds.id, title, rating_name
    FROM dvds
    INNER JOIN ratings ON dvds.rating_id = ratings.id
    WHERE title LIKE ?";

  }

  public function orderByTitle(){
    $this->sql .= "ORDER BY 'title'";

  }

  public function find(){
    $like = '%' . $this->searchTerm. '%';
    $statement = self::$pdo->prepare($this->sql);
    $statement->bindParam(1, $like);
    $statement->execute();
    return $statement->fetchAll(\PDO::FETCH_OBJ);

  }
}


 ?>
