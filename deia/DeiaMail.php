<?php
require("phpmailer/class.phpmailer.php");

class DeiaMail
{

    public $destination = NULL;
    private $smtpUser = "ibanet@ibalianca.com.br";
    private $smtpPass = "andreia3007";

    public function __construct($destination = array())
    {
        $this->destination = $destination;
    }

    public function sendSMTP($assunto, $html)
    {

        // Inicia a classe PHPMailer
        $mail = new PHPMailer();

        // Define os dados do servidor e tipo de conexão
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = "smtp.ibalianca.com.br"; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
        $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->Username = $this->smtpUser; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = $this->smtpPass; // Senha do servidor SMTP (senha do email usado)

        // Define o remetente
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = $this->smtpUser; // Seu e-mail
        $mail->Sender = $this->smtpUser; // Seu e-mail
        $mail->FromName = "IBANet"; // Seu nome

        // Define os destinatário(s)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        foreach ($this->destination as $value) {
            $mail->AddAddress($value["email"], $value["nome"]);
        }

        //$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
        //$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

        // Define os dados técnicos da Mensagem
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        //$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

        // Define a mensagem (Texto e Assunto)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject = $assunto; // Assunto da mensagem
        $mail->Body = $html;

        // Define os anexos (opcional)
        // =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
        // Envia o e-mail
        $enviado = $mail->Send();

        // Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

        // Exibe uma mensagem de resultado
        if ($enviado) {
            return true;
        } else {
            return $mail->ErrorInfo;
        }
    }
}