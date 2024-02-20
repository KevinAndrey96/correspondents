<?php

namespace App\UseCases\Contracts\Statistics;

interface GetStatisticsDataUseCaseInterface
{
    public function handle(string $dateFrom, string $dateTo, string $role, string $userID);
}
