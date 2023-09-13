<?php

namespace App\Observer;

use App\Entity\Office;

interface OfficeNotificationObserverInterface
{
    public function onOfficeCreated(Office $office): void;
}
