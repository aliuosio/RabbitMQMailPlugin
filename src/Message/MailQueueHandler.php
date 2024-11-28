<?php

declare(strict_types=1);

namespace RabbitMQMailPlugin\Message;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailQueueHandler
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(EmailMessage $message): void
    {
        $email = (new Email())
            ->to($message->getTo())
            ->subject($message->getSubject())
            ->text($message->getBody());

        $this->mailer->send($email);
    }
}
