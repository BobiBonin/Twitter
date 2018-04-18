 <?php
 session_start();

 use \model\UserDao;

 function __autoload($class)
 {
     $class = "..\\" . $class;
     require_once str_replace("\\", "/", $class) . ".php";
 }

try{
     $dao = new UserDao();
    $id = $_SESSION['user']['id'];
    $result = $dao->findFollowing($id);
    echo json_encode($result);

}catch (PDOException $e){

}


