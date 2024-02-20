<?php

namespace App\DTOs;

class StatisticsDataDTO
{
    private string $failedTransactions;
    private string $successTransactions;
    private string $cancelledTransactions;
    private string $holdTransactions;
    private string $acceptedTransactions;

    public function getFailedTransactions(): string
    {
        return $this->failedTransactions;
    }

    public function setFailedTransactions(string $failedTransactions): void
    {
        $this->failedTransactions = $failedTransactions;
    }

    public function getSuccessTransactions(): string
    {
        return $this->successTransactions;
    }

    public function setSuccessTransactions(string $successTransactions): void
    {
        $this->successTransactions = $successTransactions;
    }

    public function getCancelledTransactions(): string
    {
        return $this->cancelledTransactions;
    }

    public function setCancelledTransactions(string $cancelledTransactions): void
    {
        $this->cancelledTransactions = $cancelledTransactions;
    }

    public function getHoldTransactions(): string
    {
        return $this->holdTransactions;
    }

    public function setHoldTransactions(string $holdTransactions): void
    {
        $this->holdTransactions = $holdTransactions;
    }

    public function getAcceptedTransactions(): string
    {
        return $this->acceptedTransactions;
    }

    public function setAcceptedTransactions(string $acceptedTransactions): void
    {
        $this->acceptedTransactions = $acceptedTransactions;
    }

}
