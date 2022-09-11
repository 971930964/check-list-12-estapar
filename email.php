<?php
    // Criando nossas variáveis para guardar as informações do formulário
    $motorista=$_POST['motorista'];
    $placa=$_POST['placa'];
    $km_inicial=$_POST['km_inicial'];
    $viatura=$_POST['viatura'];
    $data=date("d/m/Y");
    $radio_luzes=$_POST['luzes'];
    $radio_seta_diant=$_POST['seta_diant'];
    $radio_seta_tras=$_POST['seta_tras'];
    $radio_freio=$_POST['freio'];
    $radio_re=$_POST['re'];
    $radio_lant_farol=$_POST['lant_farol'];
    $radio_buzina=$_POST['buzina'];
    $radio_cinto=$_POST['cinto'];
    $radio_pneus=$_POST['pneus'];
    $radio_ch_triang=$_POST['ch_triang'];
    $radio_cameras=$_POST['cameras'];
    $radio_habilit=$_POST['habilit'];
    $radio_doc_veic=$_POST['doc_veic'];
    $radio_uniforme=$_POST['uniforme'];
    $radio_cracha=$_POST['cracha'];
    $radio_tablet=$_POST['tablet'];
    $radio_pda=$_POST['pda'];
    $radio_cartao_comb=$_POST['cartao_comb'];
    $radio_sup_pda=$_POST['sup_pda'];
    $radio_sup_tab=$_POST['sup_tab'];
    $radio_protetor=$_POST['protetor'];
    $radio_carreg_veic=$_POST['carreg_veic'];
    $combustivel=$_POST['combustivel'];
    $gnv=$_POST['gnv'];
    $obs=$_POST['obs'];
    $assinatura=$_POST['assinatura'];
    $senha=$_POST['senha'];

    // formatando nossa mensagem (que será envaida ao e-mail)
    // >>>>> Aqui vc estava concatenando direto sem a "$mensagem .= "  tem que iniciar com = antes para identificar a variável
    $mensagem= '<b>CHECK-LIST</b><br>Antes da Jornada de Trabalho<br><br>';
    $mensagem.='<b>MOTORISTA:</b> '.$motorista.'<br>';
    $mensagem.='<b>PLACA VEICULO:</b> '.$placa.'<br>';
    $mensagem.='<b>KM INICIAL:</b> '.$km_inicial.'<br>';
    $mensagem.='<b>VIATURA:</b> '.$viatura.'<br>';
    $mensagem.='<b>DATA:</b> '.$data.'<br><br>';

    $mensagem.= '<b>LEGENDA:</b> OK = Em boas condicoes / R = Reparo<br>';

    $mensagem.='<b>Luzes do painel de instrumentos:</b> '.$radio_luzes.'<br>';
    $mensagem.='<b>Lampadas de seta dianteira:</b> '.$radio_seta_diant.'<br>';
    $mensagem.='<b>Lampadas de seta traseira:</b> '.$radio_seta_tras.'<br>';
    $mensagem.='<b>Lampadas de freio:</b> '.$radio_freio.'<br>';
    $mensagem.='<b>Lampadas de re:</b> '.$radio_re.'<br>';
    $mensagem.='<b>Lanternas e farois:</b> '.$radio_lant_farol.'<br>';
    $mensagem.='<b>Buzina:</b> '.$radio_buzina.'<br>';
    $mensagem.='<b>Cinto de seguranca fixacao e travamento:</b> '.$radio_cinto.'<br>';
    $mensagem.='<b>Calibragem dos pneus e estepe:</b> '.$radio_pneus.'<br>';
    $mensagem.='<b>Chave de roda e triangulo:</b> '.$radio_ch_triang.'<br>';
    $mensagem.='<b>Sistema de cameras:</b> '.$radio_cameras.'<br><br>';

    $mensagem.='<b>Habilitacao:</b> '.$radio_habilit.'<br>';
    $mensagem.='<b>Documento veiculo:</b> '.$radio_doc_veic.'<br>';
    $mensagem.='<b>Uniforme completo:</b> '.$radio_uniforme.'<br>';
    $mensagem.='<b>Cracha de identificacao:</b> '.$radio_cracha.'<br><br>';

    $mensagem.= '<b>EQUIPAMENTOS</b><br>';
    $mensagem.='<b>Tablet e cabo:</b> '.$radio_tablet.'<br>';
    $mensagem.='<b>PDA e cabo:</b> '.$radio_pda.'<br>';
    $mensagem.='<b>Cartao combustivel:</b> '.$radio_cartao_comb.'<br>';
    $mensagem.='<b>Suporte PDA:</b> '.$radio_sup_pda.'<br>';
    $mensagem.='<b>Suporte tablet:</b> '.$radio_sup_tab.'<br>';
    $mensagem.='<b>Protetor salivar:</b> '.$radio_protetor.'<br>';
    $mensagem.='<b>Carregador veicular:</b> '.$radio_carreg_veic.'<br><br>';

    

    $mensagem.='<b>QTDE. GASOLINA/ETANOL:</b> '.$combustivel.'<br>';
    $mensagem.='<b>QTDE. GNV:</b> '.$gnv.'<br><br>';

    $mensagem.='<b>OBSERVACOES:</b> '.$obs.'<br><br>';

    $mensagem.='<b>ASSINATURA:</b> '.$assinatura.'<br>';
    $mensagem.='<b>SENHA:</b> '.$senha.'<br>';

    // abaixo as requisições do arquivo phpmailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require("phpmailer/src/PHPMailer.php");
    require("phpmailer/src/SMTP.php");
    require("phpmailer/src/Exception.php");

    // chamando a função do phpmailer
    $mail = new PHPMailer();

    try{
        $mail->IsSMTP();
        
        $emailRemetente = "informacoes@masilogsolucoes.com.br";
        $emailDestinatário = "checklistgeneral@gmail.com";

        $mail->Username = $emailRemetente;
        $mail->Password = "MSLS@2132#$"; 
        
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;

        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;

        $mail->setFrom($emailRemetente, "Check-list Inicial"); // Nome do remetente
        
        $mail->addAddress($emailDestinatário); // Nome do destinatário

        $mail->IsHTML(true);

        $mail->Subject = 'VTR: '  .$viatura.  ' Motorista: ' .$motorista. ' Data: ' .$data;

        $mail->Body   = $mensagem; 

        $mail->Send();

        echo "Enviado com sucesso<br>";
        echo "------------------------------------<br>";
        echo $mensagem; 

      //  header("Location: index.html");

    }catch(Exception $e){
        echo "Não foi possível enviar o e-mail :(";
    }
?>