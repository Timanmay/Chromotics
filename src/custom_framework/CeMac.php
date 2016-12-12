<?php
/**********************************************************
********Edité par Ilangovane le 12/12/2016 à 20 h 30 ******
********************************************************/
Class CeMac{
private $id;
private $ref;
private $id_room;
private $id_user_command;
private $id_command;
 	public function __construct($reference){
 		include("../global/sql.php");
 		$req = $bdd->prepare("SELECT * FROM cemac WHERE reference = :ref");
 		$req->execute(array(':ref'=>$reference));
 		while($info = $req->fetch()){
 		 	$this->id = $info['id'];	
 		 	$this->ref = $info['reference'];
 		 	$this->id_room = $info['salle_id'];
 		 	$this->id_user_command = $info['commande_utilisateur_id'];
 		 	$this->id_command = $info['commande_id'];
 		}
 		$req->closeCursor();
 	}
 
 public function getId(){
  return $this->id;
 }
 	public function get_ref(){//return the reference 
 		return $this->ref;
 	}
 	public function get_id_room(){//return the id of the room
 		return $this->id_room;
 	}
 	public function get_id_user_command(){// return the id of the person who buy a CeMac
 		return $this->id_user_command;
 	}
 	public function get_id_command(){// return the id of the command
 		return $this->id_command;
 	}
 	public function set_ref($new_ref){
 		include("../global/sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET reference = :new WHERE id= :id");
 		$req->execute(array(':new'=>$new_ref , ':id'=>$this->id));
 		$req->closeCursor();
 		$this->ref = $new_ref;
 	}
 	public function set_id_room($new_idroom){
 		include("../global/sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET salle_id = :new WHERE id= :id");
 		$req->execute(array(':new'=>$new_idroom, ':id'=>$this->id));
 		$req->closeCursor();
 		$this->id_room = $new_idroom;
 	}
 	public function set_id_user_command($new_buyer){
 		include("../global/sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET commande_utilisateur_id = :new WHERE id = :id");
 		$req->execute(array(':new'=>$new_buyer, ':id'=>$this->id));
 		$req->closeCursor();
 		$this->id_user_command = $new_buyer;
 	}
 	public function set_id_command($new_idcommand){
 		include("../global/sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET commande_id = :new WHERE id=:id");
 		$req->execute(array(':new'=>$new_idcommand, ':id'=>$this->id));
 		$req->closeCursor();
 		$this->id_command = $new_idcommand;
 	}
}

/* A verifier les méthodes set_idèuser_command et set_id_command avec une table bien remplie (les clés étrangères compliquents les tests)
$CeMac = new CeMac("FRANCE1");


$CeMac->set_id_room(2) ;
$CeMac->set_id_user_command(1) ;
$CeMac->get_id_command(1);

echo 'Id : ' . $CeMac->getId() . '<br/>';
echo 'ref : ' . $CeMac->get_ref() . '<br/>';
echo 'Id salle: ' . $CeMac->get_id_room() . '<br/>';
echo 'id  utilisateur de la commande : ' . $CeMac->get_id_user_command() . '<br/>';
echo 'id  commande : ' . $CeMac->get_id_command() . '<br/>';

*/
