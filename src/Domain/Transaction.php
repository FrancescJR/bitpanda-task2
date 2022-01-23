<?php

declare(strict_types=1);

namespace Bitpanda\Domain;

use DateTime;

class Transaction
{
    // Since it seems there is no business logic, I am using this more like a DTO than a real entity.
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly float $amount,
        public readonly int $userId,
        public readonly DateTime $createdAt,
        public readonly DateTime $updatedAt
    ) {
    }

}
