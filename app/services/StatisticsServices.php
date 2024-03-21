<?php

namespace App\Services;

use App\Models\Statistics;

class StatisticsServices
{
    private Statistics $statistics;

    public function __construct(Statistics $statistics)
    {
        $this->statistics = $statistics;
    }

    public function getIndexData()
    {
        $indexData = [
            'count' => $this->statistics->getCountData(),
            'user' => $this->statistics->getUserData()
        ];
        
        return $indexData;
    }
}
