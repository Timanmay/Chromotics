<?php

Class Command{
	$private $date;
	$private $id_user;
	$private $id;



	public function __construct($user){
		 include("sql.php");
 		$req = $bdd->prepare("SELECT * FROM command WHERE utilisateur_id =:user");
 		$req->execute(array(':user'=>$user));
 		while($data = $req->fetch()){
 			$this->date = $data['date'];
 			$this->id_user = $data['utilisateur_id'];
 			$this->id = $data['id'];
 		}
 		$req->closeCursor();
<?php

Class Command{
	private $date;
	private $id_user;
	private $id;



	public function __construct($user){
		 include("sql.php");
 		$req = $bdd->prepare("SELECT * FROM command WHERE utilisateur_id =:user");
 		$req->execute(array(':user'=>$user));
 		while($data = $req->fetch()){
 			$this->date = $data['date'];
 			$this->id_user = $data['utilisateur_id'];
 			$this->id = $data['id'];
 		}
 		$req->closeCursor();


	}

	public function get_Date(){
		return getDate();
	}

	public function get_IdUser(){
		return $this->id_user;
	}

	public function get_Id(){
		return $this->id;
	}

	public function set_Date($date){ //$date = 'YYYY-MM-DD' only 
		 		$req = $bdd->prepare("UPDATE command SET date = :newdate WHERE id= :id");
 		$req->execute(array(':newdate' => $date , ':id'=>$this->id));
 		$req->closeCursor();
	}

	public function set_IdUser(){
		$req = $bdd->prepare("UPDATE command SET utilisateur_id = :new_user WHERE id= :id");
 		$req->execute(array(':new_user' => $date , ':id'=>$this->id));
 		$req->closeCursor();
	}









}



?>
