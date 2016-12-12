
<?php
Class Consigne
{
  private $state;//boolean type , during [begin, end] the output is on/off
  private $begin;//datetime type , the beginning of the instruction
  private $end; //datetime type , the end of the instruction
  
  public function __construct($id){
   include("../global/sql.php");
   $req = $bdd->prepare('SELECT * FROM consigne WHERE id = :id');
   $req->execute(array(':id'=>$id));
   while($data = $req->fetch()){
     $this->state = $data['etat'];
     $this->begin = $date['date_debut'];
     $this->end = $date['date_fin'];
   }
   $req->closeCursor();
    
  }
  
  public function getState(){
  return $this->state;
  }
  
  public function getBeginDatetime(){
  return $this->begin;
  }
  
  public function getEndDatetime(){
  return $this->end;
  }
  public function setState($bool){
    include("../global/sql.php");
    $req = $bdd->prepare('UPDATE consigne SET state = :bit WHERE id = :id');
    $req->execute(array(':bit'=>$bool,':id'=>$this->id));
    $req->closeCursor();
    $this->state = $bool;
    
  }
  
  public function setBeginDatetime($datetime){ //format YYYY-MM-DD hh:mm:ss
    include("../global/sql.php");
    $req = $bdd->prepare('UPDATE consigne SET date_debut = :begin WHERE id = :id');
    $req->execute(array(':begin'=>$datetime,':id'=>$this->id));
    $req->closeCursor();
    $this->begin = $datetime;
  }
  
  public function setEndDatetime(){//format YYYY-MM-DD hh:mm:ss
     include("../global/sql.php");
    $req = $bdd->prepare('UPDATE consigne SET date_fin = :end WHERE id = :id');
    $req->execute(array(':end'=>$datetime,':id'=>$this->id));
    $req->closeCursor();
    $this->begin = $datetime;
  }
  
  
  
  
}
















?>
