<?php

namespace App\Services;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;



class MailService
{
	private $mailer;

	public function __construct(MailerInterface $mailerInterface)
	{
		$this->mailer = $mailerInterface;
	}

	public function sendMail($from,	$to, $subject, $template, $context, $replyTo = null): void 
	{
		$email = (new TemplatedEmail())
			->from($from)
			->to($to)
			//->cc('cc@example.com')
			//->bcc('bcc@example.com')
			->replyTo($replyTo ? $replyTo : $from)
			//->priority(Email::PRIORITY_HIGH)
			->subject($subject)
			// chemin du template de la twig à la vue(view)
			->htmlTemplate("emails/$template.html.twig")

			

			// passer la variable (nom => valeur) au template
			->context($context); // [ 'contact' => $contact, ]

		$this->mailer->send($email);
	}
}