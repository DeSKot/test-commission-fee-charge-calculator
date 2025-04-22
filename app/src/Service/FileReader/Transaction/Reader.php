<?php
declare(strict_types=1);

namespace CommissionFeeCalculator\Service\FileReader\Transaction;

use CommissionFeeCalculator\Service\Transaction\Context\UserContextMap;
use CommissionFeeCalculator\Exceptions\Reader\CsvTransactionFileReaderException;
use CommissionFeeCalculator\Service\FileReader\Csv\Csv;
use CommissionFeeCalculator\Service\FileReader\RowDto;
use CommissionFeeCalculator\Service\Transaction\Client\Provider\Contract as ClientProviderContract;
use CommissionFeeCalculator\Traits\UserContext as UserContextTrait;
use Generator;

class Reader extends Csv
{
    use UserContextTrait;

    public function __construct(
        protected ClientProviderContract $clientProvider,
        protected UserContextMap $userContextMap,
    )
    {
    }

    function setRowDto(array $rowData): RowDto
    {
        return new TransactionRowDto($rowData);
    }

    /**
     * @throws CsvTransactionFileReaderException
     */
    public function display(Generator $rows): void
    {
        /**
         * @var TransactionRowDto $row
         */
        foreach ($rows as $row) {
            if (!$row instanceof TransactionRowDto) {
                throw new CsvTransactionFileReaderException("Invalid row data type.");
            }
            $client = $this->clientProvider->select($row->getUserType());
            $operation = $row->getOperationType();
            $client->$operation($row, $this->userContextMap);
        }
    }
}