<?php

namespace App\Service\Office\Types;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
enum Response: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
}