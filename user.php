<?php
    class User {

        private $id;
        public $_login;
        public $_password ;
        public $_email;
        public $_firstname;
        public $_lastname;

    public function __construct(){
        $this->_login;
        $this->_password;
        $this->_email;
        $this->_firstname;
        $this->_lastname;
    }

    
    public function connexion_BDD(){
            $user='root';
            $pass='';
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=classes', $user, $pass);
            return $bdd;
        }
         catch (PDOException $e ) {
            print "Erreur ! : " . $e-> getMessage()."<br>";
            die();
        }
        }

    function register($login,$password,$email,$firstname,$lastname){
        if (isset($_POST['sub'])) {
            echo "eh dude";
            $statement= $this->connexion_BDD() -> prepare('INSERT INTO utilisateurs (login,password,email,firstname,lastname ) VALUES ( :login,:password,:email,:firstname,:lastname)');
            $statement->bindParam(':login',$login,PDO::PARAM_STR);
            $statement->bindParam(':password',$password,PDO::PARAM_STR);
            $statement->bindParam(':email',$email,PDO::PARAM_STR);
            $statement->bindParam(':firstname',$firstname,PDO::PARAM_STR);
            $statement->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $statement->execute();  
        }
        
    } 
            
    

    public function ConnectUser($login, $password){
// On prépare la requête, on l'execute puis on fait un fetch pour récupérer les infos
        $ConnectUser = $this->connexion_BDD()->prepare("SELECT * FROM utilisateurs WHERE login = :login"); 
        $ConnectUser->bindValue(':login', $login, PDO::PARAM_STR); 
        $ConnectUser->execute();
        $user = $ConnectUser->fetch(PDO::FETCH_ASSOC); 
    // si fetch ok 
        if (!empty($user)) {
        if ($password==$user['password']) {
            $this->id = $user['id']; 
            $this->login = $user['login'];
            $this->password = $user['password'];

            }
            else {
                echo "mauvais login ou mdp ";
            }
        } 
    }

    public function update($login,$password,$email,$firstname,$lastname){
        if (isset($_POST['update'])) {
            $login=$_SESSION['login'];
            $update_user=$this->connexion_BDD()->prepare("UPDATE utilisateurs SET login = :login ,password = :password ,email = :email ,firstname = :firstname ,lastname = :lastname WHERE login =:login");
            $update_user->bindValue(':login',$login,PDO::PARAM_STR);
            $update_user->bindValue(':password',$password,PDO::PARAM_STR);
            $update_user->bindValue(':email',$email,PDO::PARAM_STR);
            $update_user->bindValue(':firstname',$firstname,PDO::PARAM_STR);
            $update_user->bindValue(':lastname',$lastname,PDO::PARAM_STR);
            $update_user->execute();
            if ($update_user->execute()) {
                echo "update ok";
            }
            else {
                echo "update fail ";
            }
            
        }
     
    }

    public function getAllInfos(){
        $login=$_SESSION['login'];
        $getinfo=$this->connexion_BDD()->prepare("SELECT * FROM utilisateurs WHERE login = :login")  ;
        $getinfo -> bindValue(':login',$login,PDO::PARAM_STR);
        $getinfo->execute();
        $info=$getinfo->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($info as $key ) {
            print_r ($info = array(
                "login"=>$key['login'],
                "password"=>$key['password'],
                "email"=>$key['email'],
                "firstname"=>$key['firstname'],
                "lastname" => $key['lastname']
            ));          
    }
    
}
    public function getLogin(){
        $login=$_SESSION['login'];
        $getlogin=$this-> connexion_BDD()->prepare("SELECT login FROM utilisateurs WHERE login =:login");
        $getlogin->bindValue(':login',$login,PDO::PARAM_STR);
        $getlogin->execute();
        $pseudo=$getlogin->fetchAll(PDO::FETCH_ASSOC);
        print_r ($pseudo);
    }
    public function getemail(){
        $login=$_SESSION['login'];
        $getmail=$this-> connexion_BDD()->prepare("SELECT email FROM utilisateurs WHERE login =:login");
        $getmail->bindValue(':login',$login,PDO::PARAM_STR);
        $getmail->execute();
        $email=$getmail->fetchAll(PDO::FETCH_ASSOC);
        print_r ($email);
    }
    public function getfirstname(){
        $login=$_SESSION['login'];
        $getfirstname=$this-> connexion_BDD()->prepare("SELECT firstname FROM utilisateurs WHERE login =:login");
        $getfirstname->bindValue(':login',$login,PDO::PARAM_STR);
        $getfirstname->execute();
        $prenom=$getfirstname->fetchAll(PDO::FETCH_ASSOC);
        print_r ($prenom);
    }
    public function getlastname(){
        $login=$_SESSION['login'];
        $getlastname=$this-> connexion_BDD()->prepare("SELECT lastname FROM utilisateurs WHERE login =:login");
        $getlastname->bindValue(':login',$login,PDO::PARAM_STR);
        $getlastname->execute();
        $nom=$getlastname->fetchAll(PDO::FETCH_ASSOC);
        print_r ($nom);
    }
    public function isconnected(){
        if (!empty($_SESSION == true)) {
            echo true;
        }
    }

    public function disconnect(){
        if (isset($_POST['deco'])) {
            session_destroy();
            session_unset(); 
            var_dump($_SESSION['login']);

        } 
    }

    public function delete(){
        $login=$_SESSION['login'];
            var_dump($login);
            $delete_user=$this->connexion_BDD()->prepare("DELETE FROM `utilisateurs` WHERE login = :login");
            $delete_user->bindValue(':login',$login,PDO::PARAM_STR);
            $delete_user->execute();
            session_unset();
            session_destroy();
    }

}

?>
