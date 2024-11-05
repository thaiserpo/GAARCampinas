<?php 
session_start();

include ("conexao.php"); 

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* parametros: 
/* m= e-mail
/* s= site */
$parm = $_GET['parm'];

function vacina_poli_geral($especie,$bissexto,$data_atu_jul,$connect) {
    
    $bodytext_avencer_h = "<p>Os animais abaixo estão com as vacinas a vencer em 5 dias: <br>
                 
                 <table class='table' border='1'>
						  <thead class='thead-light'>
						  <tr>
							<th scope='col'>Animal</th>
							<th scope='col'>Espécie</th>
							<th scope='col'>Responsável</th>
							<th scope='col'>Lar temporário</th>
							<th scope='col'>Última vacina</th>
							<th scope='col'>Próxima vacina</th>";
							if ($parm == '' || $parm=='s') {
    $bodytext_avencer_h .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_avencer_h .= "   </thead>
        						  <tbody> ";    
        						  
                    
    $bodytext_invalid_h = "<p> Os animais abaixo estão sem vacinas ou com datas inválidas: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>";
        							if ($parm == '' || $parm=='s') {
    $bodytext_invalid_h .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_invalid_h .= "   </thead>
        						  <tbody> ";
                    
    $bodytext_more1y_h = "<p> Os animais abaixo com vacinas vencidas há mais de 1 ano: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>
        							<th scope='col'>Próxima vacina</th>";
        							if ($parm == '' || $parm=='s') {
    $bodytext_more1y_h .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_more1y_h .= "    </thead>
        						  <tbody>"; 
    
    $bodytext_updated_h = "<p> Os animais abaixo com vacinas em dia: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>";
        							if ($parm == '' || $parm=='s') {
    $bodytext_updated_h .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_updated_h .= "     
                                  </thead>
        						  <tbody>"; 
    
    $count_avencer = 0;
    $count_invalid = 0;
    $count_more1y = 0;
    $count_updatd = 0;
    
    $querypet = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' AND DIVULGAR_COMO ='GAAR' AND ADOTADO NOT LIKE '%Adotado%' AND ADOTADO <>'Óbito'";
    $selectpet = mysqli_query($connect,$querypet); 	
    
    while ($fetchpet = mysqli_fetch_row($selectpet)) { 
        
        $id = $fetchpet[0];
        $nome_animal = $fetchpet[1];
        $especie = $fetchpet[2];
        $dtvacinacao = $fetchpet[30];
        $status = $fetchpet[10];
        $lt = $fetchpet[11];
        $resp = $fetchpet[12];
        
        $ano_dtvacinacao = substr($dtvacinacao,0,4);
        $mes_dtvacinacao = substr($dtvacinacao,5,2);
        $dia_dtvacinacao = substr($dtvacinacao,8,2);
        
        $querynotifica = "SELECT NOTIFICA_VACINA_POLI FROM NOTIFICACAO WHERE ID_ANIMAL='$id'";
        $selectnotifica = mysqli_query($connect,$querynotifica); 
        $rc = mysqli_fetch_row($selectnotifica);
        $notifica_poli = $rc[0];
	    
	    if ($notifica_poli =='SIM') {
	        $notifica_textlink = "Renotificar";
	    } else {
	        $notifica_textlink = "Notificar";
	    }
        
        /*VACINA POLIVALENTE */
        if ($ano_dtvacinacao !='0000' && $ano_dtvacinacao !='0001') {
            $dtvacinacao_jul = gregoriantojd($mes_dtvacinacao,$dia_dtvacinacao,$ano_dtvacinacao);
            $dias_dtvacinacao = (intval ($data_atu_jul) - intval ($dtvacinacao_jul) );
            $proxdtvacinacao_jul = $dtvacinacao_jul + $bissexto;
            $proxdtvacinacao = jdtogregorian ($proxdtvacinacao_jul);
            $proxdtvacinacao_tmp = str_pad($proxdtvacinacao,10,'0',STR_PAD_LEFT);
            $mes_proxdtvacinacao = substr($proxdtvacinacao_tmp,0,2);
            $dia_proxdtvacinacao = substr($proxdtvacinacao_tmp,3,2);
            $ano_proxdtvacinacao = substr($proxdtvacinacao_tmp,6,4);    
        }
        
        /* VACINA POLIVALENTE */
        switch ($dias_dtvacinacao){
            case '360':
                /* vacinas a vencer em 5 dias */
                if (checkdate($dtvacinacao) == true) { 
                    /* data válida */
                    $bodytext_avencer_d.="<tr>
            					        <td>".$nome_animal."</td>
            					        <td>".$especie."</td>
            					        <td>".$resp."</td>
            					        <td>".$lt."</td>
            					        <td>".$dia_dtvacinacao."/".$mes_dtvacinacao."/".$ano_dtvacinacao."</td>
            					        <td>".$dia_proxdtvacinacao."/".$ano_proxdtvacinacao."/".$ano_proxdtvacinacao."</td>";
            					        if ($parm == '' || $parm == 's') {
            		$bodytext_avencer_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
            					         <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."&parm=poli' target='_blank'>".$notifica_textlink."</a></td>";
            					        } 
            		$bodytext_avencer_d .="</tr>";
            		$count_avencer = $count_avencer + 1; 
                } 
                break;
            default:
                    /* data inválida */
                    if ($ano_dtvacinacao == '0000' || $ano_dtvacinacao == '0001') {
                         $bodytext_invalid_d .="<tr>
                    				        <td>".$nome_animal."</td>
                    				        <td>".$especie."</td>
                    				        <td>".$resp."</td>
                    				        <td>".$lt."</td>
                    				        <td>".$dia_dtvacinacao."/".$mes_dtvacinacao."/".$ano_dtvacinacao."</td>";
                    				        if ($parm == '' || $parm =='s') {
                		 $bodytext_invalid_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
                					                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."&parm=poli' target='_blank'>".$notifica_textlink."</a></td>";
                					        } 
                		 $bodytext_invalid_d .="</tr>";
                    	 $count_invalid = $count_invalid + 1;
                    	 
                    } elseif ($dias_dtvacinacao >= $bissexto){
                    /* vacinas vencidas há mais de 1 ano */
                        $bodytext_more1y_d .="<tr>
                					        <td>".$nome_animal."</td>
                					        <td>".$especie."</td>
                					        <td>".$resp."</td>
                					        <td>".$lt."</td>
                					        <td>".$dia_dtvacinacao."/".$mes_dtvacinacao."/".$ano_dtvacinacao."</td>
                					        <td>".$dia_proxdtvacinacao."/".$mes_proxdtvacinacao."/".$ano_proxdtvacinacao."</td>";
                					        if ($parm == '' || $parm =='s') {
                		 $bodytext_more1y_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
                					                <td><a href='http://gaarcampinas.org/area/lembretevacina.php?idanimal=".$id."&parm=poli' target='_blank'>".$notifica_textlink."</a></td>";
                					        } 
                		 $bodytext_more1y_d .="</tr>";
                		 $count_more1y = $count_more1y + 1;
                    } else {
                        $bodytext_updated_d .="<tr>
                					        <td>".$nome_animal."</td>
                					        <td>".$especie."</td>
                					        <td>".$resp."</td>
                					        <td>".$lt."</td>
                					        <td>".$dia_dtvacinacao."/".$mes_dtvacinacao."/".$ano_dtvacinacao."</td>";
                					        if ($parm == '' || $parm =='s') {
                		 $bodytext_updated_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
                		                     <td><a href='http://gaarcampinas.org/area/lembretevacina.php?idanimal=".$id."' target='_blank'>".$notifica_textlink."</a></td>";
                					        } 
                		 $bodytext_updated_d .="</tr>";
                		 $count_updated = $count_updated + 1;
                    }
        }

        
        }
    
    $bodytext_table .="   </tbody>
    			  </table>
    			  <br><br>";
    
    /*$titulo1 = "<h1> RELATÓRIO DE VACINAS </H1>";*/
    $titulo2 = "<h2> VACINA POLIVALENTE</h2>";
    
    $bodytext = $titulo1;
    $bodytext .= $titulo2;
    
    if ($count_avencer != 0) {
       $bodytext .= $bodytext_avencer_h;
       $bodytext .= $bodytext_avencer_d;
       $bodytext .= $bodytext_table;
    }
    
    if ($count_invalid != 0) {
       $bodytext .= $bodytext_invalid_h;
       $bodytext .= $bodytext_invalid_d;
       $bodytext .= $bodytext_table;
    }
    
    if ($count_more1y != 0) {
       $bodytext .= $bodytext_more1y_h;
       $bodytext .= $bodytext_more1y_d;
       $bodytext .= $bodytext_table;
    }
    
    if ($count_updated != 0) {
       $bodytext .= $bodytext_updated_h;
       $bodytext .= $bodytext_updated_d;
       $bodytext .= $bodytext_table;
    }
    
    return ($bodytext);
    
}

function vacina_raiva_geral($especie,$bissexto,$data_atu_jul,$connect) {
    
    $bodytext_avencer_raiva = "<p>Os animais abaixo estão com as vacinas a vencer em 5 dias: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>
        							<th scope='col'>Próxima vacina</th>";
        							if ($parm == '') {
    $bodytext_avencer_raiva .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_avencer_raiva .= "     
                                  </thead>
        						  <tbody>";
                    
    $bodytext_invalid_raiva = "<p> Os animais abaixo estão sem vacinas ou com datas inválidas: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>";
        							if ($parm == '') {
    $bodytext_invalid_raiva .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_invalid_raiva .= "     
                                  </thead>
        						  <tbody>";
                    
    $bodytext_more1y_raiva = "<p> Os animais abaixo com vacinas vencidas há mais de 1 ano: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>
        							<th scope='col'>Próxima vacina</th>";
        							if ($parm == '') {
    $bodytext_more1y_raiva .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_more1y_raiva .= "     
                                  </thead>
        						  <tbody>";
                    
    $bodytext_updated_raiva = "<p> Os animais abaixo com vacinas em dia: <br>
                         
                         <table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Última vacina</th>";
        							if ($parm == '') {
    $bodytext_updated_raiva .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_updated_raiva .= "     
                                  </thead>
        						  <tbody>";
    $count_avencer = 0;
    $count_invalid = 0;
    $count_more1y = 0;
    $count_updatd = 0;
    
    mysqli_data_seek($connect,0);
    
    $querypet = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' AND DIVULGAR_COMO ='GAAR' AND ADOTADO NOT LIKE '%Adotado%' AND ADOTADO <>'Óbito'";
    $selectpet = mysqli_query($connect,$querypet); 	
    
    while ($fetchpet = mysqli_fetch_row($selectpet)) { 
        
        $id = $fetchpet[0];
        $nome_animal = $fetchpet[1];
        $especie = $fetchpet[2];
        $dtvacinacao_r = $fetchpet[43];
        $status = $fetchpet[10];
        $lt = $fetchpet[11];
        $resp = $fetchpet[12];
        
        $ano_dtvacinacao_r = substr($dtvacinacao_r,0,4);
        $mes_dtvacinacao_r = substr($dtvacinacao_r,5,2);
        $dia_dtvacinacao_r = substr($dtvacinacao_r,8,2);
        
        $querynotifica_raiva = "SELECT NOTIFICA_RAIVA FROM NOTIFICACAO WHERE ID_ANIMAL='$id'";
        $selectnotifica_raiva = mysqli_query($connect,$querynotifica_raiva); 
        $rc_raiva = mysqli_fetch_row($selectnotifica_raiva);
        $notifica_raiva = $rc_raiva[0];
	    
	    if ($notifica_raiva =='SIM') {
	        $notifica_textlink = "Renotificar";
	    } else {
	        $notifica_textlink = "Notificar";
	    }
        
        if ($ano_dtvacinacao_r !='0000' && $ano_dtvacinacao_r !='0001') {
            /*VACINA DA RAIVA */
            $dtvacinacao_r_jul = gregoriantojd($mes_dtvacinacao_r,$dia_dtvacinacao_r,$ano_dtvacinacao_r);
            $dias_dtvacinacao_r = (intval ($data_atu_jul) - intval ($dtvacinacao_r_jul) );
            $proxdtvacinacao_r_jul = $dtvacinacao__r_jul + $bissexto;
            $proxdtvacinacao_r = jdtogregorian ($proxdtvacinacao_r_jul);
            $proxdtvacinacao_r_tmp = str_pad($proxdtvacinacao_r,10,'0',STR_PAD_LEFT);
            $mes_proxdtvacinacao_r = substr($proxdtvacinacao_r_tmp,0,2);
            $dia_proxdtvacinacao_r = substr($proxdtvacinacao_r_tmp,3,2);
            $ano_proxdtvacinacao_r = substr($proxdtvacinacao_r_tmp,6,4);
        }
        
        /*echo "<br> dias vacina: ".$dias_dtvacinacao;*/
        
        /* VACINA RAIVA */
        switch ($dias_dtvacinacao_r){
            case '360':
                /* vacinas a vencer em 5 dias */
                if (checkdate($dtvacinacao_r) == true) { 
                    /* data válida */
                    $bodytext_avencer_raiva.="<tr>
            					        <td>".$nome_animal."</td>
            					        <td>".$especie."</td>
            					        <td>".$resp."</td>
            					        <td>".$lt."</td>
            					        <td>".$dia_dtvacinacao_r."/".$mes_dtvacinacao_r."/".$ano_dtvacinacao_r."</td>
            					        <td>".$dia_proxdtvacinacao_r."/".$ano_proxdtvacinacao_r."/".$ano_proxdtvacinacao_r."</td>";
            					        if ($parm == '' || $parm =='s') {
        		    $bodytext_avencer_raiva .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
        					                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."' target='_blank'>".$notifica_textlink."</a></td>";
        					        } 
        		    $bodytext_avencer_raiva .="</tr>";
            		$count_avencer_r = $count_avencer__r + 1; 
                } 
                break;
            default:
                    /* data inválida */
                    if ($ano_dtvacinacao_r == '0000' || $ano_dtvacinacao_r == '0001') {
                         $bodytext_invalid_raiva .="<tr>
                    				        <td>".$nome_animal."</td>
                    				        <td>".$especie."</td>
                    				        <td>".$resp."</td>
                    				        <td>".$lt."</td>
                    				        <td>".$dia_dtvacinacao_r."/".$mes_dtvacinacao_r."/".$ano_dtvacinacao_r."</td>";
                    				       if ($parm == '' || $parm =='s') {
        		         $bodytext_invalid_raiva .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
        					                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."' target='_blank'>".$notifica_textlink."</a></td>";
        					        } 
        		         $bodytext_invalid_raiva .="</tr>";
                    	 $count_invalid_r = $count_invalid_r + 1;
                    } elseif ($dias_dtvacinacao_r >= $bissexto){
                    /* vacinas vencidas há mais de 1 ano */
                         $bodytext_more1y_raiva .="<tr>
                					        <td>".$nome_animal."</td>
                					        <td>".$especie."</td>
                					        <td>".$resp."</td>
                					        <td>".$lt."</td>
                					        <td>".$dia_dtvacinacao_r."/".$mes_dtvacinacao_r."/".$ano_dtvacinacao_r."</td>
            					            <td>".$dia_proxdtvacinacao_r."/".$ano_proxdtvacinacao_r."/".$ano_proxdtvacinacao_r."</td>";
            					            if ($parm == '' || $parm =='s') {
        		         $bodytext_more1y_raiva .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
        					                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."' target='_blank'>".$notifica_textlink."</a></td>";
        					        } 
        		         $bodytext_more1y_raiva .="</tr>";
                		 $count_more1y_r = $count_more1y_r + 1;
                    } else {
                        $bodytext_updated_raiva .="<tr>
                					        <td>".$nome_animal."</td>
                					        <td>".$especie."</td>
                					        <td>".$resp."</td>
                					        <td>".$lt."</td>
                					        <td>".$dia_dtvacinacao_r."/".$mes_dtvacinacao_r."/".$ano_dtvacinacao_r."</td>
                					        <td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
                					        <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."' target='_blank'>".$notifica_textlink."</a></td>
                                        </tr>
                					";
                		$count_updated_r = $count_updated_r + 1;
                    }
        }
        
        }
    
    $bodytext_table .="   </tbody>
    			  </table>
    			  <br><br>";
    
    $bodytext_avencer_raiva .=$bodytext_table;
    $bodytext_invalid_raiva .=$bodytext_table;
    $bodytext_more1y_raiva  .=$bodytext_table;
    $bodytext_updated_raiva .=$bodytext_table;
    			  
    /*$titulo1 = "<h1> RELATÓRIO DE VACINAS </H1>";*/
    $titulo3 = "<h2> VACINA RAIVA</h2>";
    
    $bodytext .= $titulo3;
    
    if ($count_avencer_r != 0) {
       $bodytext .= $bodytext_avencer_raiva;   
    }
    
    if ($count_invalid_r != 0) {
       $bodytext .= $bodytext_invalid_raiva;   
    }
    
    if ($count_more1y_r != 0) {
       $bodytext .= $bodytext_more1y_raiva;   
    }
    
    if ($count_updated_r != 0) {
       $bodytext .= $bodytext_updated_raiva;   
    }
    
    return ($bodytext);
    
}

function exame_fivfelv_geral($especie,$connect) {
    
    $bodytext_fivfelv_h = "<table class='table' border='1'>
        						  <thead class='thead-light'>
        						  <tr>
        							<th scope='col'>Animal</th>
        							<th scope='col'>Espécie</th>
        							<th scope='col'>Responsável</th>
        							<th scope='col'>Lar temporário</th>
        							<th scope='col'>Data do teste</th>
        							<th scope='col'>Resultado</th>";
        							if ($parm == '') {
    $bodytext_fivfelv_h .="           <th scope='col' colspan='2'>&nbsp;</th>";
        							}
    $bodytext_fivfelv_h .= "     
                                  </thead>
        						  <tbody>";
                    
    $count_fivfelv = 0;
    $count_fivfelv_invalid = 0;
    
    mysqli_data_seek($connect,0);
    
    $querypet = "SELECT * FROM ANIMAL WHERE ESPECIE ='$especie' AND DIVULGAR_COMO ='GAAR' AND ADOTADO NOT LIKE '%Adotado%' AND ADOTADO <>'Óbito'";
    $selectpet = mysqli_query($connect,$querypet); 	
    
    while ($fetchpet = mysqli_fetch_row($selectpet)) { 
        
        $id = $fetchpet[0];
        $nome_animal = $fetchpet[1];
        $especie = $fetchpet[2];
        $status = $fetchpet[10];
        $lt = $fetchpet[11];
        $resp = $fetchpet[12];
        $exame_fivfelv = $fetchpet[44];
        $dt_exame_fivfelv = $fetchpet[45];
        $dt_vermifugacao = $fetchpet[46];
        $result_exame_fivfelv = $fetchpet[47];
        
        $ano_fivfelv = substr($dt_exame_fivfelv,0,4);
        $mes_fivfelv = substr($dt_exame_fivfelv,5,2);
        $dia_fivfelv = substr($dt_exame_fivfelv,8,2);
        
        $querynotifica_fivfelv = "SELECT NOTIFICA_FIVFELV FROM NOTIFICACAO WHERE ID_ANIMAL='$id'";
        $selectnotifica_fivfelv = mysqli_query($connect,$querynotifica_fivfelv); 
        $rc_fivfelv = mysqli_fetch_row($selectnotifica_fivfelv);
        $notifica_fivfelv = $rc_fivfelv[0];
	    
	    if ($notifica_fivfelv =='SIM') {
	        $notifica_textlink = "Renotificar";
	    } else {
	        $notifica_textlink = "Notificar";
	    }

        if ($ano_fivfelv !='0000' && $ano_fivfelv !='0001') {
            /*TESTE FIVFELV */
            $bodytext_fivfelv_d .="<tr>
        				        <td>".$nome_animal."</td>
        				        <td>".$especie."</td>
        				        <td>".$resp."</td>
        				        <td>".$lt."</td>
        				        <td>".$dia_fivfelv."/".$mes_fivfelv."/".$ano_fivfelv."</td>
        				        <td>".$result_exame_fivfelv."</td>";
        				       if ($parm == '' || $parm =='s') {
	         $bodytext_fivfelv_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
				                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."&parm=fivfelv' target='_blank'>".$notifica_textlink."</a></td>";
				        } 
	         $bodytext_fivfelv_d .="</tr>";
        	 $count_fivfelv = $count_fivfelv + 1;
        }
    
        if ($ano_fivfelv == '0000' || $ano_fivfelv == '0001') {
             $bodytext_fivfelv_invalid_d .="<tr>
        				        <td>".$nome_animal."</td>
        				        <td>".$especie."</td>
        				        <td>".$resp."</td>
        				        <td>".$lt."</td>
        				        <td>".$dia_fivfelv."/".$mes_fivfelv."/".$ano_fivfelv."</td>
        				        <td>".$result_exame_fivfelv."</td>";
        				       if ($parm == '' || $parm =='s') {
	         $bodytext_fivfelv_invalid_d .= "<td><a href='http://gaarcampinas.org/area/formatualizapet.php?idanimal=".$id."' target='_blank'>Atualizar</a></td>
				                <td><a href='http://gaarcampinas.org/area/notificacao.php?idanimal=".$id."&parm=fivfelv' target='_blank'>".$notifica_textlink."</a></td>";
				        } 
	         $bodytext_fivfelv_invalid_d .="</tr>";
        	 $count_fivfelv_invalid = $count_fivfelv_invalid + 1;
        } 
    }
    
    $bodytext_fivfelv_t .="   </tbody>
    			  </table>
    			  <br><br>";
    
    $bodytext_fivfelv_invalid =$bodytext_fivfelv_h;
    $bodytext_fivfelv_invalid .=$bodytext_fivfelv_invalid_d;
    $bodytext_fivfelv_invalid .=$bodytext_fivfelv_t;
    
    $bodytext_fivfelv =$bodytext_fivfelv_h;
    $bodytext_fivfelv .=$bodytext_fivfelv_d;
    $bodytext_fivfelv .=$bodytext_fivfelv_t;
    
    $titulo1 = "<h2> TESTE FIV/FELV</h2>";
    
    $bodytext = $titulo1;
    
    if ($count_fivfelv != 0) {
       $bodytext .= "<p> Os animais abaixo estão com os testes em dia </p>";
       $bodytext .= $bodytext_fivfelv;   
    }
    
    if ($count_fivfelv_invalid != 0) {
       $bodytext .= "<p> Os animais abaixo estão sem testes </p>";
       $bodytext .= $bodytext_fivfelv_invalid;   
    }
    
    return ($bodytext);
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Meta tags Obrigatórias -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="style-area.css"/>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
    
    <title>GAAR - Relatórios</title>
    
    <style>
        .th-header {background-color: #0000A0;}
        
    </style>
    
    <script type="text/javascript">
        window.onload = function() {
          document.getElementById('text-print-relatorio').style.display = 'none';
        };
        
      setTimeout(function(){
           window.location.reload(1);
        }, 300000)
        
    </script>
      
</script>
</head>
<body> 
<?php 

$ano_atu = date("Y");
$mes_atu = date("m");
$dia_atu = date("d");

$current_dt = date("Y-m-d");

$bissexto= date('L', mktime(0, 0, 0, 1, 1, $ano_atu));

if ($bissexto =='0') {
    $bissexto = '365';
} else {
    $bissexto = '366';
}

$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);

$tmp_cat_poli = vacina_poli_geral('Felina',$bissexto,$data_atu_jul,$connect);
$tmp_cat_raiva = vacina_raiva_geral('Felina',$bissexto,$data_atu_jul,$connect);

$tmp_dog_poli = vacina_poli_geral('Canina',$bissexto,$data_atu_jul,$connect);
$tmp_dog_raiva = vacina_raiva_geral('Canina',$bissexto,$data_atu_jul,$connect);

$tmp_cat_fivfelv = exame_fivfelv_geral('Felina',$connect);

echo "<label id='topo'></label></p>";
echo "<p> Seguem abaixo os relatórios de testes FIV/FELV e vacinas (polivalentes e raiva). Clique nos links abaixo para localizar:";

if ($parm<>'m') {
    echo "<p><a href='#testefivfelv'> Teste FIV/FELV</a> <br></center>";
    echo "<p><a href='#poligato'> Vacina polivalente - gatos</a> <br></center>";
    echo "<p><a href='#policao'> Vacina polivalente - cachorro</a> <br></center>";
}

echo "<label id='testefivfelv'></label>";
echo $tmp_cat_fivfelv;
echo "<center><a href='#topo'>Voltar ao topo</a></center>";

echo "<label id='poligato'></label>";
echo $tmp_cat_poli;
echo "<center><a href='#topo'>Voltar ao topo</a></center>";

/*echo $tmp_cat_raiva;*/

echo "<label id='policao'></label>";
echo $tmp_dog_poli;
echo "<center><a href='#topo'>Voltar ao topo</a></center>";
/*echo $tmp_dog_raiva;*/


if ($parm =='m') { /* cron pra enviar por -email */

    $mail = new PHPMailer();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->CharSet = 'UTF-8';
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    $mail->SetFrom('admin@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
    $mail->IsHTML(true);
    $to = 'contato@gaarcampinas.org';
    $to='thaise.piculi@gmail.com';
    $mail->AddAddress($to);
    
    /* GATOS */
    
    $querycpg = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPG='SIM' AND STATUS_APROV='Aprovado'";
    $selectcpg = mysqli_query($connect,$querycpg);
    
    /*while ($fetchcpg = mysqli_fetch_row($selectcpg)) {
        $to =$fetchcpg[0];
        $mail->addBCC($to);
    } */
    
    $subject = "[GAAR Operacional] Relatório mensal dos gatos";
    $mail->Subject   = $subject;
    $bodytext = "<p> Olá voluntário, <br> Segue o relatório dos cadastros de vacinas e exames dos animais que estão disponíveis no site. Por gentileza, cheque e atualize caso necessário. <br>As informações também podem ser consultadas diretamente no portal: Menu Relatórios -> Operacional -> Vacinas.<br><br></p>";
    $bodytext .= exame_fivfelv_geral('Felina',$connect);
    $bodytext .= vacina_poli_geral('Felina',$bissexto,$data_atu_jul,$connect);
    $bodytext .= vacina_raiva_geral('Felina',$bissexto,$data_atu_jul,$connect);
    $mail->Body      = $bodytext;
    
    //send the message, check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'E-mail enviado! ';
    }
    
    $mail->clearAddresses();  
    
    $bodytext ='';
    
    /* CACHORROS */
    
    $to = 'contato@gaarcampinas.org';
    $mail->AddAddress($to);
    
    $querycpc = "SELECT EMAIL FROM VOLUNTARIOS WHERE CPC='SIM' AND STATUS_APROV='Aprovado'";
    $selectcpc = mysqli_query($connect,$querycpc);
    
    while ($fetchcpc = mysqli_fetch_row($selectcpc)) {
        $to =$fetchcpc[0];
        $mail->addBCC($to);
    }
    
    $subject = "[GAAR Operacional] Relatório mensal dos cães";
    $mail->Subject   = $subject;
    $bodytext = "<p> Olá voluntário, <br> Segue o relatório dos cadastros de vacinas e exames dos animais que estão disponíveis no site. Por gentileza, cheque e atualize caso necessário. <br> As informações também podem ser consultadas diretamente no portal: Menu Relatórios -> Operacional -> Vacinas.<br><br></p>";
    $bodytext .= vacina_poli_geral('Canina',$bissexto,$data_atu_jul,$connect);
    $bodytext .= vacina_raiva_geral('Canina',$bissexto,$data_atu_jul,$connect);
    $mail->Body      = $bodytext;
    
    //send the message, check for errors
    /*if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'E-mail enviado! ';
    }*/
    
    $mail->clearAddresses();   
}
mysqli_close($connect);

?>

<!--- BOOTSTRAP --->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<!--- BOOTSTRAP --->
</body>
</html>