<?php

include ("conexao.php"); 

ini_set('display_errors', 1);
            
error_reporting(E_ALL);

require_once('/home1/gaarca06/public_html/wp-includes/class-phpmailer.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mensagem = "Olá, ".$adotante."
    		
    		            Ficamos muito felizes por você ter adotado um animal com o GAAR. Segue abaixo algumas dicas e a cópia virtual do seu termo de adoção para armazenamento, esse termo não substitui o termo físico quando for levar o animal em alguma clínica veterinária conveniada para ter desconto. Estamos enviando também algumas dicas que podem te ajudar na adaptação :)
    		            
    		            Sabe aquelas compras do dia a dia para seu pet? Você pode programá-las gratuitamente, receber em qualquer lugar do Brasil, ter liberdade total para alterar datas e produtos e ainda ganhar 10% OFF sempre! Sem taxas de adesão ou cancelamento, é assim que funciona a Assinatura GAAR Campinas em parceria com a Petlove - o maior petshop online do Brasil 

                            O mais legal de tudo é que 10% do valor de suas compras (exceto frete) é doado ao GAAR em dinheiro 
                            
                            Seja um novo assinante ou migre sua assinatura existente, garanta os melhores produtos para seu melhor amigo e ajude a garantir alimentação e cuidados para os animais assistidos pela ONG. 
                            
                            Veja como é fácil:
                            
                            1. Acesse https://gaarcampinas.petlove.com.br/
                            2. Clique no menu Assinatura e logo depois Criar assinatura 
                            3. Faça seu login, ou caso não tenha crie uma conta 
                            4. Adicione os produtos que deseja receber 
                            5. Escolha a data da primeira entrega e o intervalo entre as entregas 
                            6. Confira os dados de pagamento e entrega
                            
                            Promoção exclusiva para novos Assinantes. Desconto + Cashback de até R$ 100,00 aplicado diretamente no carrinho de compras, na criação da primeira Assinatura
                            
                            E pronto! Você receberá os produtos escolhidos na frequência escolhida :) 
                            
                            Já é assinante? Migre a sua assinatura para o GAAR, os benefícios e produtos serão mantidos. Veja como: 
                            
                            1. Acesse https://gaarcampinas.petlove.com.br/ 
                            2. Faça seu login, ou caso não tenha crie uma conta 
                            3. Clique no menu Assinatura e logo depois Minhas assinaturas 
                            4. Escolha a assinatura que deseja migrar e clique em Ver detalhes 
                            5. Clique em Migrar assinatura e confirme 
                            
                            Caso não queira ser assinante, não tem problema. Toda compra que for realizada em nossa lojinha vai ter os 10% do valor doado à ONG ;) 
                
                            ⚠️ Utilize o cupom BOASVINDAS para sua primeira compra e aproveite os melhores produtos selecionados para deixar seu amigo mais feliz e saudável! Desconto aplicado direto no carrinho apenas para a primeira compra por CPF/usuário. Válido até 09/01/2023
";          
    		          
    	    switch ($especie){
    	        case 'Canina':
    	            $mensagem .= ">DICAS
                                  1. Castração: é o item no 1! > Castre a fêmea e o macho entre 5 e 6 meses de idade para que eles fiquem mais caseiros e saudáveis.
                                    A fêmea deve ser castrada não só para evitar filhotes, mas também para prevenir piometra (infecção uterina), câncer e doenças de transmissão venérea, como o TVT (Tumor Venéreo Transmissível) que ocorrem nos órgãos genitais e até no focinho, pois é causada por vírus. 
                                    No macho o mais importante é a prevenção de câncer de próstata e também o TVT. O macho deve ser castrado para evitar fugas pela ansiedade de sentir o odor de fêmeas no cio de até 2 km de distância. Também evita que ele tenha o péssimo hábito de perturbar as pernas das visitas e urinar em todos os cantos da casa para demarcar território. 
                                    2. Ao adotar, coloque uma plaquinha ou escreva o nome e telefone na coleira,> caso o cão recém-adotado escape, pois no início ainda não considera como sua a nova casa. 
                                    3. Alimentação: dê ração de boa qualidade (tipo Premium ou superior) duas vezes ao dia,> lembre – se que ração barata não tem proteína suficiente, ou a origem a proteína é péssima, e em pouco tempo seu lindo cão estará magro, triste e com a pelagem opaca. Dê ração de filhotes até os 9 meses de idade, a vontade.  Nunca compre a granel, de sacos abertos, prefira rações com embalagem do fabricante com a data de fabricação. Deixe vários potes de água disponíveis, limpos e com água fresca.
                                    4. >Se o cão fizer buracos na terra jogue as fezes dele dentro de cada buraco e tampe. 
                                    5. >Coloque telas nas janelas do apartamento. 
                                    6. >Vacine anualmente contra CINOMOSE, HEPATITE, PARVOVIROSE, PARAINFLUENZA, TRAQUEOBRONQUITE, CORONAVIROSE, LEPTOSPIROSES e Raiva. Só dê vacina em veterinários e nunca em casa de ração. Estas últimas não protegem seu animal adequadamente. 
                                    7. >Vermifugue adultos 2 vezes ao ano. Filhotes, pelo menos 3 vezes com intervalo de 10-15 dias. 
                                    8. >Se parar de comer leve imediatamente ao seu veterinário preferido. Não automedique. 
                                    9. >Dê brinquedos, cenouras ou ossos defumados para roer. 
                                    10. Tenha paciência com a animação dos filhotes, >a fase das mordidas diminui após a troca de dentes que ocorre dos 4 aos 6 meses! 
                                    
                                    Dra Ingrid Menz CRMV-SP 1569 - veterinária voluntária da ONG
                                    
                                    ";
    	            break;
    	            
    	        case 'Felina':
    	            $mensagem .= "<h4>DICAS</h4>
                                  <p>1. Castração: é o item no 1! Castre a fêmea e o macho entre 5 e 6 meses de idade para que eles fiquem mais caseiros e saudáveis.
                                    A fêmea deve ser castrada não só para evitar filhotes, mas também para prevenir piometra (infecção uterina), câncer e várias doenças. 
                                    O macho deve ser castrado para evitar miados e namoros no telhado, não deixando ninguém dormir; para não ser arranhado e mordido por outros gatos; não infectar-se com doenças infecciosas graves, como a leucemia (FeLV) e a imunodeficiência felinas (FIV), transmitida pela saliva de gatos doentes.
                                    2. Ao adotar, deixe o gato novo em quarto fechado por 1 semana para se adaptar aos novos odores, sons, pessoas.> Será seu refúgio em caso de perigo. Depois vá soltando lentamente pela casa. Evite deixá-lo na rua/telhados/casa do vizinho, é uma questão de tempo e o gatinho vai sumir, sofre acidente ou ser eliminado por um cão ou humano. 
                                    3. Alimentação: >dê ração de boa qualidade (tipo Premium ou superior) para evitar futura insuficiência renal. Dê ração de filhotes até os 9 meses de idade. Dê alimento úmido  (sachê ou carne/peixe) de vez em quando. 
                                    4. Banheiro: >coloque areia sanitária (inúmeras marcas) em caixa plástica de altura condizente com o tamanho do gato. Adultos precisam de caixas mais altas para não derramar areia para fora enquanto “enterram” suas necessidades. Gatos não precisam ser treinados, eles já fazem tudo certinho. 
                                    <strong>NÃO deixe a caixa-banheiro próximo da água e da comida.> Limpe a caixa de areia duas vezes ao dia, pelo menos. Eles detestam banheiro sujo.
                                    5. Coloque telas em todas as janelas de todo apartamento, inclusive as do banheiro. >Gatos podem se distrair com um passarinho ou inseto e cair. Geralmente morrem. Sobreviver é exceção.
                                    6. Coloque coleirinha para que os vizinhos saibam que este gato tem dono.
                                    7. Vacine anualmente contra Panleucopenia (Parvovirose do gato), Calicivirose,  Rinotraqueíte, Clamidiose, Leucemia Felina e Raiva. Só dê vacina em veterinários e nunca em casa de ração. Estas últimas não protegem seu animal adequadamente.
                                    8. Vermifugue adultos 2 vezes ao ano. Filhotes, pelo menos 2 vezes com, intervalo de 10-15 dias. 
                                    9. Corte a pontinha das unhas a cada 15-20 dias.
                                    10. Se parar de comer leve imediatamente ao seu veterinário preferido.
                                    11. Dê brinquedos, bolinhas de papel, tapete de sisal ou capachos, arranhadores... eles adoram.
                                    12. Tenha paciência com a animação dos filhotes! Você vai curtir muito!
                                    LEMBRE-SE: TER UM GATO FAZ VOCE TER SORTE, SER FELIZ E RENOVA SUAS ENERGIAS E O BOM HUMOR. 
                                    
                                    Dra Ingrid Menz CRMV-SP 1569 - veterinária voluntária da ONG
                                    
                                    ";
    	            break;
    	            
    	    }
    		             
    		$mensagem .= "A cópia digital do termo de adoção e a foto da adoção estão em anexo caso tenham sido carregadas em nosso sistema.";
                        
$bodytext = $mensagem;

$to = 'thaise.piculi@gmail.com';
$email = new PHPMailer();
$email->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$email->msgHTML(file_get_contents('contents.html'), __DIR__);
$email->SetFrom('contato@gaarcampinas.org', 'GAAR Campinas'); //Name is optional
$email->Subject   = 'Teste de anexo';
$email->Body      = $bodytext;
$email->IsHTML(true);
$email->AddAddress($to);
$to = 'gaarcampinas@gmail.com';
$email->AddAddress($to);

$nome_foto = "20200123_175808.jpg";

$file_to_attach = '/home1/gaarca06/private/docs/termos/'.$nome_foto;

$email->addAttachment($file_to_attach, 'Termo digital');

$nome_fotoad = "20200202_124902.jpg";

$file_to_attach2 = '/home1/gaarca06/public_html/docs/adotantes/'.$nome_fotoad;

$email->addAttachment($file_to_attach2, 'Foto adocao');

//send the message, check for errors
if (!$email->send()) {
    echo 'Mailer Error: ' . $email->ErrorInfo;
} else {
    echo 'E-mail enviado! ';
}

?>
