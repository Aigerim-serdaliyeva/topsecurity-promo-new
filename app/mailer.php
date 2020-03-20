<?php
	define("AUTH_SERVER", "smtp.mail.ru");
	define("AUTH_PORT", "465");
	define("AUTH_LOGIN", "no-reply@topsecurity.kz");
	define("AUTH_PASSWORD", "ct4pRuRA1yR$");

	define("EMAIL_FROM", "no-reply@topsecurity.kz");
	define("EMAIL_NAME", "Top Security Promo");
	define("EMAIL_SUBJECT", "Заказали звонок");
	define("EMAIL_BODY", "Имя - %s <br> Телефон - %s");

	require __DIR__.'/mailer/PHPMailerAutoload.php';

	/* make model data */
	$data = array_merge(array(
		'name' 		=> NULL,
		'phone' 	=> NULL,
	), $_POST);

	/* sanitize value */
	foreach($data as $key => $value) {
		$data[$key] = strip_tags(htmlspecialchars($value));
	}
	if (!empty($data['name']) && !empty($data['phone'])) {
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->isHTML(true);
		$mail->SMTPAuth     = true;
		$mail->SMTPSecure   = 'ssl';
		$mail->CharSet 	= 'utf-8';
		$mail->Host 	= AUTH_SERVER;
		$mail->Port     = AUTH_PORT;
		$mail->Username = AUTH_LOGIN;
		$mail->Password = AUTH_PASSWORD;

		$mail->SetFrom(AUTH_LOGIN, EMAIL_NAME);        
        $mail->addAddress('info@topsecurity.kz');		                   
        $mail->addCC("v.klepikova@muratov.kz");
        $mail->addCC("y.shmatkova@muratov.kz");        
        $mail->addCC("sanch941@gmail.com");
		$mail->Subject = EMAIL_SUBJECT;
		$mail->Body	   = sprintf(EMAIL_BODY, $data['name'], $data['phone']);
		$mail->send();
	}
