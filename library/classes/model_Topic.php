<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';
class Topic_Service {

    public function __construct () {}

    public function create ($name) {
        $db   = linkLocal();
		$sql  = "INSERT INTO topic ( name ) VALUES ( :name )";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":name", $name, PDO::PARAM_STR);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
    }
    public function delete () {
        $db = linkLocal();
		$sql = "DELETE FROM topic WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
    }
    public function getAll () {
        $db = linkLocal();
		$sql = "SELECT * FROM topic";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$postData = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $postData;
    }
  

}