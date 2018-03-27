<?php
if(isset($_POST['email']))
    $email_to = "p.diaz@luxmarketing.mx";
    $email_subject = "Your email subject line";
    function died($error) {
        echo "Lo sentimos, pero hemos detectado algunos errores, favor de corregirlos para continuar. ";
        echo "Los errores se ven abajo.<br /><br />";
        echo $error."<br /><br />";
        echo "Porfavor ir hacia atras y corregir los errores.<br /><br />";
        die();
    }
    if(!isset($_POST['name']) ||
       !isset($_POST['email']) ||
       !isset($_POST['telephone']) ||
       !isset($_POST['comments'])) {
        died('Lo sentimos, parece haber un error en el formulario ingresado.');       
    }
    $first_name = $_POST['name'];
    $email_from = $_POST['email'];
    $telephone = $_POST['telephone'];
    $comments = $_POST['comments'];
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'La direccion de correo electronico parece no ser valido.<br />';
    }
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$first_name)) {
        $error_message .= 'El primer nombre no parece ser valido.<br />';
    }
    if(strlen($comments) < 2) {
        $error_message .= 'Los comentarios ingresados parecen no ser validos.<br />';
    }
    if(strlen($error_message) > 0) {
        died($error_message);
    }
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    $email_message .= "Primer Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
    $email_message .= "Comentarios: ".clean_string($comments)."\n";
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);  
?>
<!-- HTML Aqui-->
Gracias por Contactarnos, pronto nos comunicaremos con Usted.
<?php
 
}
 
?>
