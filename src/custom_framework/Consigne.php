<?php
Class Command{
	private $date;
	private $id_user;
	private $id;


	public function __construct($id_user){//par exemple id de luttilsateur session
		 include("../global/sql.php");
 		$req = $bdd->prepare("SELECT * FROM commande WHERE utilisateur_id =:user");
 		$req->execute(array(':user'=>$id_user));
 		while($data = $req->fetch()) {
 			$this->date = $data['date'];
 			$this->id_user = $data['utilisateur_id'];
 			$this->id = $data['id'];
 		}
 		$req->closeCursor();
	}

	public function get_Date(){
		return $this->date;
	}

	public function get_IdUser(){
		return $this->id_user;
	}

	public function get_Id(){
		return $this->id;
	}

	public function set_Date($date){ //$date = 'YYYY-MM-DD' only 
		include("../global/sql.php");
		 $req = $bdd->prepare("UPDATE commande SET date = :newdate WHERE id= :id");
 		$req->execute(array(':newdate' => $date , ':id'=>$this->id));
 		$req->closeCursor();
 		$this->date = $date;
	}

	public function set_IdUser($new_user){
		include("../global/sql.php");
		$req = $bdd->prepare("UPDATE commande SET utilisateur_id = :new_user WHERE id= :id");
 		$req->execute(array(':new_user'=> $new_user , ':id'=> $this->id));
 		$req->closeCursor();
 		$this->id_user = $new_user;
	}
}


/* TEST : toute les fonctions marche très bien
$command = new Command(1);
echo 'La date de la commande est le : ' . $command->get_Date() . '<br/>';
echo 'Le proprietaire l\'utilisateur_id = ' .$command->get_IdUser() . '<br/>';
echo 'L\'id de la commande est :'. $command->get_Id() . '<br/>';


echo $command->set_Date('2013-01-02 12:55:32') . '<br/>';
echo $command->set_IdUser(2) . '<br/>';

echo 'La date de la commande est le : ' . $command->get_Date() . '<br/>';
echo 'Le proprietaire l\utilisateur_id = ' .$command->get_IdUser() . '<br/>';
echo 'L\'id de la commande est :' . $command->get_Id() . '<br/>';
*/
?>
