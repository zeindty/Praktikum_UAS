<?php

session_start();

$database= 'localhost';
$database_user= 'root';
$database_password='';
$database_name= 'data_user';

//connect to database

$con=mysqli_connect($database, $database_user, $database_password, $database_name );

if(mysqli_connect_errno()){
    exit('failed to connect to the database : ' .mysqli_connect_errno());
}

// prepare oure SQL statement and prevent injection

if($stmt=$con->prepare('SELECT id, password FROM accounts WHERE email = ?')){
    //now let we bind the parameters, so user name is a string so we use "s"
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();

    //now let we store the result we can check if the account existe
    $stmt->store_result();

    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $password);
        $stmt->fetch();

        //so now we know the account exist let we now verify the password
        if($_POST['password'] === $password){
            //now the user should log in andwe create asession so weknowthe user has loggedin
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $SESSION['name'] = $_POST['email'];
            $SESSION['id'] = $id;
            header('Location: view/animal/indexanimal.php');
            exit;
            
        }
    }
}
