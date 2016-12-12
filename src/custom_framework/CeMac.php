<?php

Class CeMac{
private $id;
private $ref;
private $id_room;
private $id_user_command;
private $id_command;

 	public function __construct($reference){
 		include("sql.php");
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
 		return $id_user_command;
 	}

 	public function get_id_command(){// return the id of the command
 		return $this->id_command;
 	}

 	public function set_ref($new_ref){
 		include("sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET reference = :new WHERE ref= :old");
 		$req->execute(array(':new'=>$new_ref , ':old'=>$this->ref));
 		$req->closeCursor();
 		$this->ref = $newref;
 	}

 	public function set_id_room($new_idroom){
 		 include("sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET salle_id = :new WHERE salle_id= :old");
 		$req->execute(array(':new'=>$new_idroom, ':old'=>$this->id_room));
 		$req->closeCursor();
 		$this->id_room = $newid;
 	}

 	public function set_id_user_command($new_buyer){
 		 include("sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET commande_utilisateur_id = :new WHERE commande_utilisateur_id = :old");
 		$req->execute(array(':new'=>$new_buyer, ':old'=>$this->id_user_command));
 		$req->closeCursor();
 		$this->id_user_command;
 	}

 	public function set_id_command($new_idcommand){
 		 		 include("sql.php");
 		$req = $bdd->prepare("UPDATE cemac SET command_id = :new WHERE command_id= :old");
 		$req->execute(array(':new'=>$new_idcommand, ':old'=>$this->id_command));
 		$req->closeCursor();
 		$this->id_command;
 	}





}
