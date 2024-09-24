<?php

namespace App\Http\Controllers;

use App\DTOs\StatisticsDataDTO;
use App\Http\Resources\StatisticsResource;
use App\UseCases\Contracts\Statistics\GetStatisticsDataUseCaseInterface;
use Illuminate\Http\Request;

class StatisticsDataController extends Controller
{
    private GetStatisticsDataUseCaseInterface $getStatisticsDataUseCase;

    public function __construct(GetStatisticsDataUseCaseInterface $getStatisticsDataUseCase)
    {
        $this->getStatisticsDataUseCase = $getStatisticsDataUseCase;
    }


    public function __invoke(Request $request)
    {
        $dateFrom = str_replace('/', '-',$request->input('dateFrom'));
        $dateTo = str_replace('/', '-',$request->input('dateTo'));
        $role = $request->input('userRole');
        $userID = $request->input('userID');

        $data = $this->getStatisticsDataUseCase->handle($dateFrom, $dateTo, $role, $userID);

        $failedTransactions = $data['failedTransactions'];
        $successTransactions = $data['successTransactions'];
        $cancelledTransactions = $data['cancelledTransactions'];
        $holdTransactions = $data['holdTransactions'];
        $acceptedTransactions = $data['acceptedTransactions'];
        $userRole = $data['userRole'];
        $userID = $data['userID'];

        return new StatisticsResource(
            $failedTransactions,
            $successTransactions,
            $cancelledTransactions,
            $holdTransactions,
            $acceptedTransactions,
            $userRole,
            $userID
        );


    }



}
