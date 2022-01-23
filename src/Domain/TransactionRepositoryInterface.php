<?php

declare(strict_types=1);

namespace Bitpanda\Domain;

interface TransactionRepositoryInterface
{
    /**
     * @return Transaction[]
     */
    public function searchAll(): array;

}
