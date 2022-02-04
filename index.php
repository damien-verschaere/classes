<?php 
        session_start();
        require_once "userpdo.php";
        
        if (isset($_POST["sub"])){
            $user = new User();
            $user->register($_POST['login'],$_POST['password'],$_POST['email'],  $_POST['firstname'],$_POST['lastname']); 
             
        }
        if (isset($_POST["connexion"])){
            $user = new User($login,$password);
            $user->ConnectUser($_POST['login'], $_POST['password']);
            $_SESSION['login']=$_POST['login'];
            $user->isconnected();
            
            }
        if (isset($_POST['sup'])) {
            $user=new User();
            $user ->delete();
        }
        if (isset($_POST['update'])) {
            $user=new User();
            $user->update($_POST['login'],$_POST['password'],$_POST['email'],$_POST['firstname'],$_POST['lastname']);
        }
  
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <header>
    </header>
    <h1>INSCRIPTION</h1>
    
    <form action="index.php" method="post">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="firstname" placeholder="prenom">
        <input type="text" name="lastname" placeholder="nom">
        <input type="submit" name="sub">
    </form>
    <br>
    <br>
    <h2>CONNEXION</h2>
    <form action="index.php" method="POST">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="connexion">
    </form>
    <br>
    <br>
    <form action="index.php">
        <input type="submit" value="deconnexion" name="deco">
    </form>
    <br>
    <br>
    <br>
    <form action="index.php" method="post">
        <input type="submit" value="DELETE" name="sup">
    </form>
    <br>
    <br>
    <br>
    <h2>UPDATE</h2>
   <form action="index.php" method="post">

        <input type="text" name="login" placeholder="login">
        <input type="email" name="email" placeholder="email">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="text" name="lastname"placeholder="lastname">
        <input type="text" name="password" placeholder="password">
        <input type="submit" name="update">
   </form>
   <table>
       <p><?= $user->getAllInfos() ?></p>
       <thead>
           <tr>
            <th>login</th>
            <th>email</th>
            <th>firstname</th>
            <th>lastname</th>
           </tr>
       </thead>
       <tbody>
           <tr>
               <th><?= $user->getLogin();?></th>
               <th><?= $user->getemail();?></th>
               <th><?= $user->getfirstname();?></th>
               <th><?= $user->getlastname();?></th>
           </tr>
       </tbody>
   </table>
        
</body>
</html>