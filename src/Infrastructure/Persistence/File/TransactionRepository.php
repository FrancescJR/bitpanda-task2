<?php

declare(strict_types=1);

namespace Bitpanda\Infrastructure\Persistence\File;


use Bitpanda\Domain\Transaction;
use Bitpanda\Domain\TransactionRepositoryInterface;
use DateTime;

class TransactionRepository implements TransactionRepositoryInterface
{
    private const CSV_FILE = '../transactions.csv';

    public function searchAll(): array
    {
        $domainTransactions = [];
        if (($handle = fopen(self::CSV_FILE, "r")) !== false) {
            while (($csvTransaction = fgetcsv($handle, 1000, ",")) !== false) {
                if ($csvTransaction[0] == 'id') {
                    continue;
                }
                $domainTransactions[] = $this->toDomain($csvTransaction);
            }
            fclose($handle);
        }

        return $domainTransactions;
    }

    private function toDomain(array $csvLine): Transaction
    {
        // just assuming data needs no validation.
        return new Transaction(
            (int)$csvLine[0],
            $csvLine[1],
            (float)$csvLine[2],
            (int)$csvLine[3],
            new DateTime($csvLine[4]),
            new DateTime($csvLine[5])
        );
    }
}
