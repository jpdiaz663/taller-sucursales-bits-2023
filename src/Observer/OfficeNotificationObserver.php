<?php

namespace App\Observer;

use App\Entity\Notification;
use App\Entity\Office;
use App\Repository\NotificationRepository;

/**
 * Strategy and Observer
 * Class OfficeNotificationObserver
 * @package App\Observer
 * @author bits.JuanDiaz <juan.diaz@bitsamericas.com>
 */
class OfficeNotificationObserver implements OfficeNotificationObserverInterface
{

    public function __construct(private readonly NotificationRepository $notificationRepository)
    {
    }

    public function onOfficeCreated(Office $office): void
    {
        $currency = $office->getCurrency();
        $vars = sprintf('The office has created with currency code: "%d"', $currency->getSign());

        $content = <<<HTML
<html>
<head></head>
<body>
$vars
</main>
</html>
HTML;
        $notification = new Notification();
        $notification->setOffice($office);
        $notification->setContent($content);
        $this->notificationRepository->save($notification);
    }
}
