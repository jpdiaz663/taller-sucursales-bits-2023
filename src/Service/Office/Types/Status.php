<?php
declare(strict_types=1);

namespace App\Service\Office\Types;

/**
 * @author bitsJuan.Diaz <juan.diaz@bitsamericas.com>
 */
enum Status: string {
    case DELETED = 'DELETED';
    case ACTIVE = 'ACTIVE';
}