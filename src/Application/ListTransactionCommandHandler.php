<?php

declare(strict_types=1);

namespace Bitpanda\Application;

use Bitpanda\Domain\TransactionRepositoryInterface;

class ListTransactionCommandHandler
{
    public function __construct(private TransactionRepositoryInterface $transactionRepository)
    {
    }

    /**
     * @param ListTransactionsCommand $command
     * @return TransactionResponse[]
     */
    public function __invoke(ListTransactionsCommand $command): array
    {
        $transactions = $this->transactionRepository->searchAll();

        $response = [];

        foreach ($transactions as $transaction) {
            $response[] = TransactionResponse::fromTransaction($transaction);
        }

        return $response;
    }

}
