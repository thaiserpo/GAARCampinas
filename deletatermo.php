<?php 
session_start();

include ("conexao.php"); 

$login = $_SESSION['login'];

if($login == "" || $login == null){
	      echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não identificado, por favor faça o login');window.location.href='login.html'</script>";
}else{

$logarray = $array['login'];
$idtermo = $_GET['idtermo'];

$uploaddir_termos = '/home/gaarca06/public_html/docs/termos/';
$uploaddir_adotantes = '/home/gaarca06/public_html/docs/adotantes/';

/*echo"<script language='javascript' type='text/javascript'>
          if */
             $query = "SELECT FOTO ,FOTO_ADOTANTE FROM TERMO_ADOCAO WHERE ID = '$idtermo' ";
             $select = mysqli_query($connect,$query);
             
             while ($fetch = mysqli_fetch_row($select)) {
                    $foto = $fetch[0];
                    $foto_adotante = $fetch[1];
                } 
             
             $foto_termo = $uploaddir_termos.$foto;
             $adotantes = $uploaddir_adotantes.$foto_adotante;
             
             $query = "DELETE FROM TERMO_ADOCAO WHERE ID = '$idtermo'";
             $delete = mysqli_query($connect,$query);
             if($delete){
                       unlink($foto_termo);
                       unlink($adotantes);
                       echo"<script language='javascript' type='text/javascript'>
                       alert('Termo deletado com sucesso!');window.location.href='pesquisatermo.php';</script>";
             }else{
                       echo"<script language='javascript' type='text/javascript'>
                       alert('Erro ao deletar');window.location.href='pesquisatermo.php';</script>";
                     }
            /*echo "}";*/
             }
?>