<?php 

Class SignUp{

		public $nom;//nom du client
		public $prenom;//prenom du client
		public $mdp;//mot de passe du client
		public $adresse;// adresse du client
		public $ref; // reference d'un capteur(1)/actionneur(0) OU cemac ("CeMac")
		public $is_capteur;// vaut 1 si le produit acheté est un capteur
		public $is_Cemac;// vaut "Cemac" si le produit achété est un Cemac
		public $id_service;//A chaque service correspond un numéro par exemple capteur de température => 1 
		public $id_user;// l'id du nouveau client présente dans la base de données

		public function __construct($nom2,$prenom2,$mail2,$mdp2,$adresse2,$ref2,$is_capteur2,$is_Cemac2,$id_service2){
			//affectation + sécurité lié au formulaire d'inscription
			$this->nom = strip_tags($nom2);
			$this->prenom = strip_tags($prenom2);
			$this->mail = strip_tags($mail2);
			$this->mdp = strip_tags($mdp2);
			$this->adresse = strip_tags($adresse2);
			$this->ref = strip_tags($ref2);
			$this->is_capteur = (int)$is_capteur2;
			$this->is_Cemac = strip_tags($is_Cemac2);
			$this->id_service = strip_tags($id_service2);

		}




		public function insert_user(){//la fonction les infos du nouveau client dans la table Utilisateur et return l'id de celui-ci
		include('../global/sql.php');
			$req = $bdd->prepare("INSERT INTO utilisateur(nom,prenom,email,mdp,statut,adresse) VALUES(:nom,:prenom,:mail,:mdp,'client',:adresse) ");
			$req->execute(array(':nom'=>$this->nom,
								':prenom'=>$this->prenom,
								':mail'=>$this->mail,
								':mdp'=>$this->mdp,
								':adresse'=>$this->adresse));
			$lastId = $bdd->lastInsertId();
			$req->closeCursor();
			return $lastId;

		}

		public function ajout_membre_verification(){//Après avoir vérifié le produit acheté on ajoute le membre dans la base de données
		include('../global/sql.php');


			
			if($this->is_Cemac == 'CeMac'){
					//on commence par vérifier que le client a bien acheter un équipement en boutique en fournissant la reference
					$nb =$this->countCeMac();
					if($nb == 0){
						echo "Cette article n'existe pas ou a été déjà renseigné par un autre membre ou bien vous avez mal rempli le formulaire!";
						return 0;
					}else{
						
						$this->id_user = $this->insert_user();
						echo'ajout de luser'.$this->id_user;
						$this->updateCeMac();
					}
					
			}else{
					//on commence par vérifier que le client a bien acheter un équipement en boutique en fournissant la reference, le type et le service 
					$nb = $this->countCapteurActionneur();
					if($nb == 0){
						echo "Cette article n'existe pas ou a été déjà renseigné par un autre membre ou bien vous avez mal rempli le formulaire!";
						return 0;
					}else{

						$this->id_user = $this->insert_user();
						echo'ajout de luser' . $this->id_user;
					}


					$this->updateCapteurActionneur();
			}

			$this->updateCommande();


		}



		public function countCeMac(){//compte le nombre de Cemac correspondant à la REF $this->ref, 0 est eliminatoire
		include('../global/sql.php');
			$buy = $bdd->prepare('SELECT count(id) AS nb FROM cemac WHERE reference =:ref  ');
					$buy->execute(array(':ref'=>$this->ref));
					while($data = $buy->fetch()){
						$nb = $data['nb'];
					}
					if(!isset($nb)){
						$nb=0;
					}
					$buy->closeCursor();
					return $nb;

		}


		public function countCapteurActionneur(){/*compte le nombre de capteurs/actionneurs correspondant à la REF $this->ref au service $this->id_service est au capteur $this->is_capteur, 0 est eliminatoire (cette fonction est plus sévère que le CountCemac())*/
		include('../global/sql.php');
			$buy = $bdd->prepare('SELECT count(id) AS nb FROM capteur_actionneur WHERE reference =:ref AND capteur = :is_capteur AND service_id = :id_service AND commande_utilisateur_id IS NULL');
					$buy->execute(array(':ref'=>$this->ref,
										':is_capteur'=>$this->is_capteur,
										':id_service'=>$this->id_service));
					while($data = $buy->fetch()){
						$nb = $data['nb'];
					}
					if(!isset($nb)){
						$nb=0;
					}
					$buy->closeCursor();
					return $nb;
		}
		public function updateCeMac(){//actualise la table Cemac en donnant un propriétaire au Cemac de reference $this->ref
		include('../global/sql.php');

			$buy = $bdd->prepare('SET foreign_key_checks = 0;
				UPDATE cemac SET commande_utilisateur_id = :id_user WHERE reference =:ref ;  ');
					$buy->execute(array(':id_user'=>$this->id_user,':ref'=>$this->ref));
					$buy->closeCursor();
					
		}
		function updateCapteurActionneur(){//actualise la table capteur_actionneur en donnant un propriétaire au capteur/actionneur de reference $this->ref, de service $this->id_service et capteur $this->is_capteur
		include('../global/sql.php');

					$ca = $bdd->prepare("SET foreign_key_checks = 0 ;
						UPDATE capteur_actionneur SET commande_utilisateur_id = :id_user WHERE reference =:ref AND capteur = :is_capteur AND service_id = :id_service ;");
					$ca->execute(array(
										':id_user'=>$this->id_user,
										':ref'=>$this->ref,
										':is_capteur'=>$this->is_capteur,
										':id_service'=>$this->id_service));

					$ca->closeCursor();
		}




		public function updateCommande(){//met à jour la table commande 
				if($this->is_Cemac){
						include('../global/sql.php');

									$up = $bdd->prepare("SET foreign_key_checks = 0 ;
										UPDATE commande SET utilisateur_id = :id_user WHERE id = (SELECT commande_id FROM cemac WHERE reference =:ref ) ;");
									$up->execute(array(
														':id_user'=>$this->id_user,
														':ref'=>$this->ref));

									$up->closeCursor();

				}else{
						include('../global/sql.php');

									$up = $bdd->prepare("SET foreign_key_checks = 0 ;
										UPDATE commande SET utilisateur_id = :id_user WHERE id = (SELECT commande_id FROM cemac WHERE ref = :ref");
									$up->execute(array(
														':id_user'=>$this->id_user,
														':ref'=>$this->ref));

									$up->closeCursor();



				}

		}


}


function type(){//récupère tous les services proposés par Chromotics au niveau capteur/actionneur
include('../global/sql.php');
	$req = $bdd->prepare("SELECT * FROM service ");
	$req->execute(array());
	echo '<select name="service">';
	echo '<option value="CeMac">CeMac</option>';
	 while($data = $req->fetch()){
	 	
	 	echo '<option value="'. $data['id']. '">'. $data['nom'] . '</option>';
	}
	echo '</select>';
	$req->closeCursor();
}

?>