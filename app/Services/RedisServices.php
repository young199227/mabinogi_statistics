<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;
use App\Services\StatisticsServices;

class RedisServices
{
    private StatisticsServices $statisticsServices;

    public function __construct(StatisticsServices $statisticsServices)
    {
        $this->statisticsServices = $statisticsServices;
    }

    public function redisGetIndexData()
    {
        #如果indexData不存在 就存入Redis
        if (!Redis::exists('indexData')) {
            $indexData = $this->statisticsServices->getIndexData();

            #轉json存入Redis
            $indexData = json_encode($indexData);
            Redis::set('indexData', $indexData);
        }

        #轉array回傳 因為controller會包成json回傳
        return json_decode(Redis::get('indexData'));
    }

    public function forceRedisGetIndexData()
    {
        $indexData = $this->statisticsServices->getIndexData();
        $indexData = json_encode($indexData);
        Redis::set('indexData', $indexData);
    }
}
