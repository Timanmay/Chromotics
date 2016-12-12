
<?php

/***********************************************************************
************************Modifié par ilangovane 20:15********************
*********************************************************************/
Class Consigne
{
  private $state;//boolean type , during [begin, end] the output is on/off
  private $begin;//datetime type , the beginning of the instruction
  private $end; //datetime type , the end of the instruction
  private $id;//id of the consigne 

  public function __construct($id){
   include("../global/sql.php");
   $req = $bdd->prepare('SELECT * FROM consigne WHERE id = :id');
   $req->execute(array(':id'=>$id));
   while($data = $req->fetch()){
     $this->state = $data['etat'];
     $this->begin = $data['date_debut'];
     $this->end = $data['date_fin'];

     $this->id = $data['id'];
   }
   $req->closeCursor();
    
  }
  
  public function getId(){
    return $this->id;
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
    $req = $bdd->prepare('UPDATE consigne SET etat = :state WHERE id = :id');
    $req->execute(array(':state'=>$bool,':id'=>$this->id));
    $req->closeCursor();
    $this->state = $bool;
    
  }
  
  public function setBeginDatetime($datetime){ //format YYYY-MM-DD hh:mm:ss
    include("../global/sql.php");
    $req = $bdd->prepare('UPDATE consigne SET date_debut = :date1 WHERE id = :id');
    $req->execute(array(':date1'=>$datetime,':id'=>$this->id));
    $req->closeCursor();
    $this->begin = $datetime;
  }
  
  public function setEndDatetime($datetime){ //format YYYY-MM-DD hh:mm:ss
    include("../global/sql.php");
    $req = $bdd->prepare('UPDATE consigne SET date_debut = :date1 WHERE id = :id');
    $req->execute(array(':date1'=>$datetime,':id'=>$this->id));
    $req->closeCursor();
    $this->end = $datetime;
  }
  
  
  
  
}


/* La classe marche très bien
$consign = new Consigne(1);
echo 'id : ' . $consign->getId() . '<br/>';
echo 'Etat : ' . $consign->getState() . '<br/>' ;
echo 'Debut : ' . $consign->getBeginDatetime() . '<br/>' ;
echo 'Fin :' . $consign->getEndDatetime() . '<br/>' ;

echo $consign->setState(1) . '<br/>' ;
echo $consign->setBeginDatetime('2010-08-02 11:30:23') . '<br/>' ;
echo $consign->getEndDatetime('2020-08-02 11:30:23') . '<br/>' ;



echo 'Etat : ' . $consign->getState() . '<br/>' ;
echo 'Debut : ' . $consign->getBeginDatetime() . '<br/>' ;
echo 'Fin :' . $consign->getEndDatetime() . '<br/>' ;
*/









?>
