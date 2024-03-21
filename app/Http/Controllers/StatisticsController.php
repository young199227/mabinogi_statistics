<?php

namespace App\Http\Controllers;

use App\Models\connect;
use App\Models\statistics;
use App\Services\StatisticsServices;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    private Statistics $statistics;
    private Connect $connect;
    private StatisticsServices $statisticsServices;

    public function __construct(Statistics $statistics, Connect $connect, StatisticsServices $statisticsServices)
    {
        $this->statistics = $statistics;
        $this->connect = $connect;
        $this->statisticsServices = $statisticsServices;
    }

    #首頁
    public function showIndex(Request $request)
    {
        #先記錄一次進站IP與時間
        $this->connect->createConnect($request->ip());

        #拿首頁資料
        $indexData = $this->statisticsServices->getIndexData();

        return response()->json(['data' => $indexData, 'message' => '首頁!'], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(statistics $statistics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, statistics $statistics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(statistics $statistics)
    {
        //
    }
}
