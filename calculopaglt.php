<?php

include ("conexao.php"); 

        function calculo_valor_pgto_mensal($qtdedia,$valordia){
				
				$valor = floatval($qtdedia) * floatval($valordia);
				
				return ($valor);
		}

		/*$query = "SELECT * FROM TERMO_ADOCAO WHERE POS_ADOCAO = '0001-01-01' ";*/
		
		$ano_atu = date("Y");
		$mes_atu = date("m");
		$mes_ant = date('m',strtotime('-1 months')); /* mês passado */
		$mes_ant_2 = date('m',strtotime('-2 months')); /* mês retrasado */
		$dia_atu = date("d");
		$ultimo_dia = cal_days_in_month (CAL_GREGORIAN,$mes_ant,$ano_atu);

		/* TESTE 
		$mes_atu = '09';
		$mes_ant = '03';
		$mes_ant_2 = '02';
		$dia_atu = '01';
		/* TESTE */
		
		$dtatu = date("Y-m-d");
		
		$dtatu_format = date("d-m-Y");
		
		$data_atu_jul = gregoriantojd($mes_atu,$dia_atu,$ano_atu);
		
		$data_ant_jul = gregoriantojd($mes_ant,'01',$ano_atu);
		
		$data_ant2_jul = gregoriantojd($mes_ant_2,$dia_atu,$ano_atu);
		
		$querydel = "DELETE FROM HISTORICO_PAG_LT WHERE MES_VIGENTE = '$mes_atu' AND ANO_VIGENTE = '$ano_atu' ";
		$selectdel = mysqli_query($connect,$querydel);
		
		$query = "SELECT * FROM ANIMAL WHERE DIVULGAR_COMO = 'GAAR' AND ESPECIE = 'CANINA'";
		$select = mysqli_query($connect,$query);
		$reccount = mysqli_num_rows($select);
		
		while ($fetch = mysqli_fetch_row($select)) {
		    $id = $fetch[0];
		    $nomedoanimal = $fetch[1];
		    $dtnasc =  $fetch[3];
		    $idadejul = $fetch[29];
		    $lt = $fetch[11];
		    $resp = $fetch[12];
		    $dtentrada = $fetch[13];
		    $dtsaida = $fetch[14];
		    $status = $fetch[10];
		    
		    $ano_dtentrada = substr($dtentrada,0,4);
		    $mes_dtentrada = substr($dtentrada,5,2);
		    $dia_dtentrada = substr($dtentrada,8,2);
		    
		    $ano_dtsaida = substr($dtsaida,0,4);
		    $mes_dtsaida = substr($dtsaida,5,2);
		    $dia_dtsaida = substr($dtsaida,8,2);
		    
		    /* CONVERSAO DATA GREG TO JD */

		    $dtentrada_jul = gregoriantojd($mes_dtentrada,$dia_dtentrada,$ano_dtentrada);
		    
		    $dtsaida_jul = gregoriantojd($mes_dtsaida,$dia_dtsaida,$ano_dtsaida);
		    
		    /* CALCULO DE DIAS */
		  
		    $diasentrada = intval($data_atu_jul) - intval($dtentrada_jul) ;
		    
		    $diassaida = intval($data_atu_jul) - intval($dtsaida_jul) ;

		    if ($diassaida == 737506) {
		        $diassaida = 0;
		    }
		    
		    if ($diasentrada == 737506) {
		        $diasentrada = 0;
		    }
		    
		    $querylt = "SELECT * FROM LT WHERE LAR_TEMPORARIO= '$lt'";
    		$selectlt = mysqli_query($connect,$querylt);
    		$reccountlt = mysqli_num_rows($selectlt);
    		
    		while ($fetchlt = mysqli_fetch_row($selectlt)) {
    		    $valor_dia_ate6m = $fetchlt[21];
    		    $valor_dia_mais6m = $fetchlt[22];
    		    $valor_dia_adulto = $fetchlt[23];
    		    $dia_pgto = $fetchlt[20];
    		    
		        $dt_pgto = $ano_atu."-".$mes_atu."-".$dia_pgto;
    		    
    		}
		    
		    if ($idadejul <='182'){
		        $valor_dia = $valor_dia_ate6m;
		    }
		    if (($idadejul > '182') &&  ($idadejul <='366')){
		        $valor_dia = $valor_dia_mais6m;
		    }
		    if ($idadejul > '366'){
		        $valor_dia = $valor_dia_adulto;
		    }
		    
		    ini_set('display_errors', 1);
        
    		error_reporting(E_ALL);
    		
		    if ($valor_dia <> 0){

		        $periodo_fim_jul = gregoriantojd($mes_ant,$ultimo_dia,$ano_atu);
		
    		    switch ($status) {
    		        
    		        case 'Adotado':
    		            $periodo_ini_jul = gregoriantojd($mes_ant,'01',$ano_atu);
    		            
    		            if ($ano_dtsaida == $ano_atu && $mes_dtsaida == $mes_ant) {
    		                
    		                    $qtd_dias = $dia_dtsaida;
    		                    $periodo_ini = $ano_atu ."-".$mes_dtsaida."-01"; 
    		                    $periodo_fin = $dtsaida;
                		        $valorpago = floatval($valor_dia) * $qtd_dias;  
                		        
                		        echo "<br>----------------------------------";
                                echo "<br> nome do animal: ".$nomedoanimal;
                                echo "<br> status        : ".$status;
                                echo "<br>data de saída  : ".$dia_dtsaida."-".$mes_dtsaida."-".$ano_dtsaida;
                                echo "<br>data atual     : ".$dia_atu."-".$mes_atu."-".$ano_atu;
                        		echo "<br>mês anterior   : ".$mes_ant;
                        		echo "<br>valor do dia   : ".$valor_dia;
                        		echo "<br>qtde de dias   : ".$qtd_dias;
                                echo "<br>valor pago     : ".$valorpago;
                                echo "<br>data pgto      : ".$dt_pgto;
                                
                                $queryinsert = " INSERT INTO HISTORICO_PAG_LT
            		                 (NOME_ANIMAL,
            		                  LAR_TEMPORARIO,
            		                  RESPONSAVEL,
            		                  VALOR_DIA,
            		                  VALOR_PAGO,
            		                  DATA_PGTO,
            		                  PERIODO_INICIAL,
            		                  PERIODO_FINAL,
            		                  QTDE_DIAS,
            		                  MES_VIGENTE,
            		                  ANO_VIGENTE,
            		                  ADOTADO,
            		                  DATA_NASC)
            		                  VALUES
            		                  ('$nomedoanimal',
            		                  '$lt',
            		                  '$resp',
            		                  '$valor_dia',
            		                  '$valorpago',
            		                  '$dt_pgto',
            		                  '$periodo_ini',
            		                  '$periodo_fin',
            		                  '$qtd_dias',
            		                  '$mes_atu',
            		                  '$ano_atu',
            		                  '$status',
            		                  '$dtnasc')";
            		
            		            $insert = mysqli_query($connect,$queryinsert); 	
            		            echo "<br> SQL code: ".mysqli_errno($connect) ;
    		            }
                        break;
                    
                    case 'Disponível':
                    case 'Indisponível':

                        /*$qtd_dias = intval($data_ant_jul) - intval($data_ant2_jul);*/
                    
                        if (($ano_dtentrada == $ano_atu) && ($mes_dtentrada == $mes_ant)) {
                            $periodo_ini = $ano_dtentrada ."-".$mes_dtentrada."-".$dia_dtentrada;
                            $periodo_ini_jul = gregoriantojd($mes_dtentrada,$dia_dtentrada,$ano_dtentrada);
                        } else {
                            $periodo_ini = $ano_atu ."-".$mes_ant."-01"; 
                            $periodo_ini_jul = gregoriantojd($mes_ant,'01',$ano_atu);
                        }
                        
                        $qtd_dias = (intval($periodo_fim_jul) - intval($periodo_ini_jul)) + intval(1);
                        
    		            $periodo_fin = $ano_atu ."-".$mes_ant."-".$ultimo_dia; 
    		            
                        $valorpago = floatval($valor_dia) * $qtd_dias;      
                        
                        if ($nomedoanimal == 'BOB PARAPLÉGICO'){
                            $valorpago = '750';
                        }

                        $queryinsert = " INSERT INTO HISTORICO_PAG_LT
            		                 (NOME_ANIMAL,
            		                  LAR_TEMPORARIO,
            		                  RESPONSAVEL,
            		                  VALOR_DIA,
            		                  VALOR_PAGO,
            		                  DATA_PGTO,
            		                  PERIODO_INICIAL,
            		                  PERIODO_FINAL,
            		                  QTDE_DIAS,
            		                  MES_VIGENTE,
            		                  ANO_VIGENTE,
            		                  ADOTADO,
            		                  DATA_NASC)
            		                  VALUES
            		                  ('$nomedoanimal',
            		                  '$lt',
            		                  '$resp',
            		                  '$valor_dia',
            		                  '$valorpago',
            		                  '$dt_pgto',
            		                  '$periodo_ini',
            		                  '$periodo_fin',
            		                  '$qtd_dias',
            		                  '$mes_atu',
            		                  '$ano_atu',
            		                  '$status',
            		                  '$dtnasc')";
            		
            		    $insert = mysqli_query($connect,$queryinsert); 	
            		    
            		    echo "<br> SQL code: ".mysqli_errno($connect) ;
                        
                        break;
    		    }

            		$message = "" ;
            		
            		/*mail($to, $subject, $message, $headers);*/
            		
            	    if(mysqli_errno($connect) <> '0'){
            	        
                        $from = "contato@gaarcampinas.org";
            		
                		$to = "thaise.piculi@gmail.com";
                		
                		$subject = "[GAAR Campinas] Erro ao atualizar a tabela HISTORICO_PAG_LT";
                		
                		$headers = "MIME-Version: 1.0\n";               
                		$headers .= "Content-type: text/html; charset=utf-8\n";            
                		$headers .= "From: <{$from}> \r\n";
                		$headers .= "Reply-To: <{$from}> \r\n";    
                
                		$message = "Mensagem de erro: ".mysqli_error($connect). " <br>SQL Error: ".mysqli_errno($connect);
                		
                		/*mail($to, $subject, $message, $headers);*/
                    }
                        
    		    }
		    }                		     

		
?>