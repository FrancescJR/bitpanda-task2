<?php

declare(strict_types=1);

namespace Bitpanda\Infrastructure\UI\HttpController;

use Bitpanda\Infrastructure\Persistence\Eloquent\TransactionRepository as EloquentTransactionRepository;
use Bitpanda\Infrastructure\Persistence\File\TransactionRepository as FileRepository;
use Bitpanda\Application\ListTransactionCommandHandler;
use Bitpanda\Application\ListTransactionsCommand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AllTransactionsController
{
    public const SOURCE_DATABASE = 'db';
    public const SOURCE_CSV = 'csv';

    public function __construct(
        private EloquentTransactionRepository $eloquentRepository,
        private FileRepository $fileRepository
    )
    {

    }

    public function __invoke(Request $request): JsonResponse
    {
        // Using Symfony Dependency injection might be a little bit more elegant
        // on the other hand, I like having things ultra specific so they are easy to understand.

        // Here I am genuinely interested on how you would think is the best way, probably a "laravelly way"
        // so I can see if I can somehow port it to an hexagonal architecture.

        // Well one thing is that this logic is in the infrastructure and it is very unclear whether should be placed
        // in the domain, I just assume it is indeed something technical and that the domain doesn't care
        // whether the transactions come from A or B. But on the other hand... it is the client of the API who
        // decides by passing the parameter, making it somehow more part of the business domain.

        $repository = match($request->get('source')) {
            self::SOURCE_DATABASE => $this->eloquentRepository,
            self::SOURCE_CSV => $this->fileRepository,
            default => throw new HttpException(Response::HTTP_BAD_REQUEST,'Invalid source')
        };

        $transactions = (new ListTransactionCommandHandler(
            $repository
        ))(new ListTransactionsCommand());

        return new JsonResponse($transactions, Response::HTTP_OK);

    }

}
