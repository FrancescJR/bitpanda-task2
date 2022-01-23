<?php

declare(strict_types=1);

namespace Bitpanda\Infrastructure\Persistence\Eloquent;

use Bitpanda\Domain\Transaction;
use Bitpanda\Domain\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository extends Model implements TransactionRepositoryInterface
{
    // Active record doesn't really follow repository pattern
    // But I am just going fast.
    protected $table = 'transactions';

    public function searchAll(): array
    {
        $transactions = $this->all();
        $domainTransactions = [];
        foreach($transactions as $transaction) {
            $domainTransactions[] = $this->toDomain($transaction);
        }
        return $domainTransactions;
    }

    private function toDomain($eloquentTransaction): Transaction
    {
        return new Transaction(
            $eloquentTransaction->id,
            $eloquentTransaction->code,
            (float) $eloquentTransaction->amount,
            $eloquentTransaction->user_id,
            $eloquentTransaction->created_at,
            $eloquentTransaction->updated_at
        );
    }
}
