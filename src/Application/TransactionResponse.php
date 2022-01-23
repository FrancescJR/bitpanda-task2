<?php

declare(strict_types=1);

namespace Bitpanda\Application;

use Bitpanda\Domain\Transaction;
use DateTime;

class TransactionResponse implements \JsonSerializable
{
    private function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly int $userId,
        public readonly float $amount,
        public readonly DateTime $createdAt,
        public readonly DateTime $updatedAt
    ){}

    public static function fromTransaction(Transaction $transaction): self
    {
        return new self(
            $transaction->id,
            $transaction->code,
            $transaction->userId,
            $transaction->amount,
            $transaction->createdAt,
            $transaction->updatedAt
        );
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'user_id' => $this->userId,
            'amount' => $this->amount,
            'created_at' => $this->createdAt->format('c'),
            'updated_at' => $this->updatedAt->format('c')
        ];
    }
}
