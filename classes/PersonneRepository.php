<?php
include_once 'autoload.php';
include_once 'fragments/header.php';

class PersonneRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('admins');
    }
    public function findAll() {
        $request = "select * from ".$this->tableName;
        $response =$this->bd->prepare($request);
        $response->execute([]);
        return $response->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id) {
        $request = "select * from ".$this->tableName ." where id = ?";
        $response =$this->bd->prepare($request);
        $response->execute([$id]);
        return $response->fetch(PDO::FETCH_OBJ);
    }

    public function findByIdAndDelete($id){
        $mail = (self::findById($id))->mail;

        $request= "DELETE FROM ".$this->tableName ." where id = ?";
        $response =$this->bd->prepare($request);
        $response->execute([$id]);

        
        $actionDescription = self::actionDesc($id,$mail,"removing ");

    }
    public function addToDatabse($tab)
    {   
        
        $path = $_FILES['image']['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $filename = uniqid() .".".$ext;
        move_uploaded_file($_FILES['image']['tmp_name'], 'pictures/'.$filename);
        $request = "Insert into admins (mail,isadmin,image,password) VALUES ( '".$tab['mail']."' , '".$tab['isAdmin']."' ,'".$filename."','".$tab['password']."')";
        // $request="INSERT INTO ".$this->tableName ." (mail, password, isAdmin, image)
        // VALUES('" . $tab['mail'] . "','". $tab['password'] . "','". $tab['isAdmin'] . "','" . $filename ."');";
        $response =$this->bd->prepare($request);
        $response->execute();
        
        $id = (self::findByEmail($tab['mail']))->id;
        $actionDescription = self::actionDesc($id,$tab['mail'],"adding ");
        ;
    }

    
    public static function addLog($s){
        while(true){
            try{
                $fp = fopen('data.txt', 'a');
                fwrite($fp, $s);  
                fclose($fp);  
                return;           
            }
            catch(Exception $e){
                echo 'The file is being used by another process... ';
                sleep(1);
            }
        }
    }

    
    public static function actionDesc($id,$mail,$string){
        self::logMessageCreation($string."  user( mail= ".$mail.",id=".$id.")"); 
    }

    public static function logMessageCreation($actionDesc){
        $currDate = date("Y:m:d:i:sa");
        $str = $currDate . " -- " .$_SESSION['user']." -- ".$actionDesc."\n\n";
        
        self::addLog($str); //add a log with the action that has taken place;
    }

    public static function delete($old){
        unlink('pictures/'.$old);
    }

    public function changeDatabase($tab){


        var_dump($_FILES['image']) ;
        if($_FILES['image']['name']==""){
            $request="UPDATE ".$this->tableName." SET mail='".$tab['mail']."', password='".$tab['password']."', isAdmin = '".$tab['isAdmin']."', image = '".$tab['oldImage']."'  WHERE id='". $tab['id']."'";
            echo $request;
            $response =$this->bd->prepare($request);
            $response->execute([]);
        }
        else{
            $path = $_FILES['image']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $filename = uniqid() .".".$ext;
            move_uploaded_file($_FILES['image']['tmp_name'], 'pictures/'.$filename);
            $request="UPDATE ".$this->tableName." SET mail='".$tab['mail']."', password='".$tab['password']."', isAdmin = '".$tab['isAdmin']."', image = '".$filename."'  WHERE id='". $tab['id']."'";
            $response =$this->bd->prepare($request);
            $response->execute([]);
            if ($filename != $tab['oldImage']) 
                self::delete($tab['oldImage']);
        }

        $newTab = self::findById($tab['id']);
        $actionDescription = self::actionDesc($tab['id'],$tab['mail'],"modifying ");
    }
}