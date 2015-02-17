<?php
session_start();
include_once "conexion.php";

echo '<div style="text-align:center"><div style="font-size:45px;">Pl&aacute;sticos Sylka SA de CV</div></div>';
echo '<div style="text-align:center"><div style="font-size:35px;">Acceso asesores</div></div>';

function verificar_login($user,$password,&$result) {
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' and password = '$password'";
    $rec = mysql_query($sql);
    $count = 0;
    $_SESSION["usuario"] = $user;

    while($row = mysql_fetch_object($rec))
    {
        $count++;
        $result = $row;
    }

    if($count == 1)
    {
        return 1;
    }

    else
    {
        return 0;
    }
}

if(!isset($_SESSION['userid']))
{
    if(isset($_POST['login']))
    {
        if(verificar_login($_POST['user'],$_POST['password'],$result) == 1)
        {
            $_SESSION['userid'] = $result->idusuario;
            header("location:asesor.php");
        }
        else
        {
            echo '<div class="error">Los datos no son correctos, favor de verificar.</div>';
        }
    }
?>

<style type="text/css">
*{
	font-size: 26px;
}
form.login {
    background: none repeat scroll 0 0 #F1F1F1;
    border: 2px solid #DDDDDD;
    font-family: sans-serif;
    margin: 0 auto;
    padding: 20px;
    width: 478px;
}
form.login div {
    margin-bottom: 15px;
    overflow: hidden;
}
form.login div label {
    display: block;
    float: left;
    line-height: 45px;
}
form.login div input[type="text"], form.login div input[type="password"] {
    border: 1px solid #DCDCDC;
    float: right;
    padding: 4px;
}
form.login div input[type="submit"] {
    background: none repeat scroll 0 0 #DEDEDE;
    border: 1px solid #C6C6C6;
    float: right;
    font-weight: bold;
    padding: 4px 20px;
}
.error{
    color: red;
    font-weight: bold;
    margin: 10px;
    text-align: center;
}
</style>

<form action="" method="post" class="login">
	<div><label>Nombre de Asesor:</label><input name="user" type="text" ></div>
	<div><label>Password:</label><input name="password" type="password"></div>
	<div><input name="login" type="submit" value="Enviar"></div>
</form>
<?php
} else {
	echo '<a href="logout.php"><div style="text-align:center"><div style="font-size:45px;">Salir</div></div></a>';
}
?>
