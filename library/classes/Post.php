<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/library/includes.php';
class Post {
	
	public $id           = null;
	public $titleWeb     = "";
	public $titleBlog    = "";
	public $summary      = "";
	public $markup       = "";
	public $videoEmbed   = null;
	public $videoUrl     = null;
	public $userId       = null;
	public $status		 	 = null;
	public $iconPath	 	 = null;
	public $topicId      = null;

	public function __construct($status, $infoArr){

		switch($status) {

			case "create":
				if(empty($infoArr['titleWeb']) || 
				   empty($infoArr['titleBlog'])|| 
				   empty($infoArr['summary'])  || 
				   empty($infoArr['markup'])   || 
				   empty($infoArr['userId'])   ||
				   empty($infoArr['topicId'])  ||
				   empty($infoArr['status'])   ||
				   empty($infoArr['iconPath'])) {
						var_dump($infoArr);
				// send an error that an empty input exits

					break;
				}

				$this->titleWeb   = $infoArr['titleWeb'];
				$this->titleBlog  = $infoArr['titleBlog'];
				$this->summary    = $infoArr['summary'];
				$this->markup     = $infoArr['markup'];
				$this->videoEmbed = $infoArr['videoEmbed'];
				$this->videoUrl   = $infoArr['videoUrl'];
				$this->userId     = $infoArr['userId'];
				$this->status     = $infoArr['status'];
				$this->iconPath   = $infoArr['iconPath'];
				$this->topicId    = $infoArr['topicId'];
				
				break;

			case "edit":
			
				if(empty($infoArr['id']) 			|| 
					empty($infoArr['titleWeb'])		|| 
					empty($infoArr['titleBlog'])	|| 
					empty($infoArr['summary'])		|| 
					empty($infoArr['markup'])		|| 
					empty($infoArr['iconPath'])		|| 
					empty($infoArr['status'])		||
					empty($infoArr['topicId'])) {

					// send an error that an empty input exits

					break;
				}

				$this->id         = $infoArr['id'];
				$this->titleWeb   = $infoArr['titleWeb'];
				$this->titleBlog  = $infoArr['titleBlog'];
				$this->summary    = $infoArr['summary'];
				$this->markup     = $infoArr['markup'];
				$this->videoEmbed = $infoArr['videoEmbed'];
				$this->videoUrl   = $infoArr['videoUrl'];
				$this->iconPath   = $infoArr['iconPath'];
				$this->status     = $infoArr['status'];
				$this->topicId    = $infoArr['topicId'];
				break;
		}
	}

	public function create() {
		$db   = linkLocal();
		$sql  = "INSERT INTO post ( titleWeb, titleBlog, summary, markup, videoEmbed, videoUrl, user_id, topic_Id, status, iconPath) VALUES (:titleWeb, :titleBlog, :summary, :markup, :videoEmbed, :videoUrl, :userId, :topicId, :status, :iconPath)";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":titleWeb",   $this->titleWeb, 		PDO::PARAM_STR);
		$stmt->bindValue(":titleBlog",  $this->titleBlog, 	PDO::PARAM_STR);
		$stmt->bindValue(":summary",    $this->summary, 		PDO::PARAM_STR);
		$stmt->bindValue(":markup",     $this->markup, 			PDO::PARAM_STR);
		$stmt->bindValue(":videoEmbed", $this->videoEmbed, 	PDO::PARAM_STR);
		$stmt->bindValue(":videoUrl",   $this->videoUrl, 		PDO::PARAM_STR);
		$stmt->bindValue(":userId",     $this->userId, 			PDO::PARAM_INT);
		$stmt->bindValue(":topicId",    $this->topicId, 		PDO::PARAM_INT);
		$stmt->bindValue(":status",     $this->status, 			PDO::PARAM_STR);
		$stmt->bindValue(":iconPath",   $this->iconPath, 		PDO::PARAM_STR);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
	}

	public function edit() {
		$db   = linkLocal();
		$sql  = "UPDATE post SET titleWeb=:titleWeb, titleBlog=:titleBlog, summary=:summary, markup=:markup, videoEmbed=:videoEmbed, videoUrl=:videoUrl, modified=:modified, topic_id=:topicId, status=:status, iconPath=:iconPath WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id",         $this->id, 				PDO::PARAM_INT);
		$stmt->bindValue(":titleWeb",   $this->titleWeb, 	PDO::PARAM_STR);
		$stmt->bindValue(":titleBlog",  $this->titleBlog, PDO::PARAM_STR);
		$stmt->bindValue(":summary",    $this->summary, 	PDO::PARAM_STR);
		$stmt->bindValue(":markup",     $this->markup, 		PDO::PARAM_STR);
		$stmt->bindValue(":videoEmbed", $this->videoEmbed,PDO::PARAM_STR);
		$stmt->bindValue(":videoUrl",   $this->videoUrl, 	PDO::PARAM_STR);
		$stmt->bindValue(":topicId",   	$this->topicId, 	PDO::PARAM_INT);
		$stmt->bindValue(":status",   	$this->status, 		PDO::PARAM_STR);
		$stmt->bindValue(":iconPath",   $this->iconPath, 	PDO::PARAM_STR);
		$stmt->bindValue(":modified",   date("Y-m-d h:i:sa"));
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
	}


	}

class Post_Service {

	public function __construct(){}

	public function getById($id) {
		$db = linkLocal();
		$sql = "SELECT * FROM post WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$postData = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmt->closeCursor();
		return $postData;
	}

	public function getByAuthorId($author_id) {
		$db = linkLocal();
		$sql = "SELECT * FROM post WHERE user_id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id", $author_id, PDO::PARAM_INT);
		$stmt->execute();
		$postData = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $postData;
	}

	public function getBySearch($queryString) {
		$db = linkLocal();
		$sql = "SELECT * FROM post WHERE summary LIKE '%' :queryString '%'";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":queryString", $queryString, PDO::PARAM_STR);
		$stmt->execute();
		$postData = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $postData;
	}

	public function getAll() {
		$db = linkLocal();
		$sql = "SELECT * FROM post";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$postData = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $postData;
	}

	public function getVariable($num) {
		$db = linkLocal();
		$sql = "SELECT * FROM post ORDER BY id DESC LIMIT " . $num;
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$postData = $stmt->fetchAll(PDO::FETCH_NAMED);
		$stmt->closeCursor();
		return $postData;
	}

	public function deleteById($id) {
		$db = linkLocal();
		$sql = "DELETE FROM post WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->bindValue(":id", $id, PDO::PARAM_INT);
		$stmt->execute();
		$rowsChanged = $stmt->rowCount();
		$stmt->closecursor();
		return $rowsChanged;
	}
}