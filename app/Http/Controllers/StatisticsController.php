<?php

namespace App\Http\Controllers;

use App\Models\connect;
use App\Models\statistics;
use App\Services\StatisticsServices;
use App\Services\RedisServices;
use Illuminate\Http\Request;
use App\Http\Requests\StatisticsRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;


class StatisticsController extends Controller
{
    private Statistics $statistics;
    private Connect $connect;
    private StatisticsServices $statisticsServices;
    private RedisServices $redisServices;

    public function __construct(Statistics $statistics, Connect $connect, StatisticsServices $statisticsServices, RedisServices $redisServices)
    {
        $this->statistics = $statistics;
        $this->connect = $connect;
        $this->statisticsServices = $statisticsServices;
        $this->redisServices = $redisServices;
    }

    #測試用
    public function test(Request $request)
    {
    }

    #首頁
    public function getIndexData(Request $request)
    {
        #先記錄一次進站IP與時間
        $this->connect->createConnect($request->ip());

        #Redis拿首頁資料
        $indexData = $this->redisServices->redisGetIndexData();

        return response()->json(['data' => $indexData, 'message' => '首頁!'], 200);
    }

    #拿csrf_token
    public function getToken()
    {
        $token = Session::token();

        return response()->json(['data' => ['token' => $token], 'message' => 'token!'], 200);
    }

    #使用者上傳
    public function create(StatisticsRequest $request)
    {
        #新增使用者上傳 回傳成功或失敗
        $this->statisticsServices->create($request);

        return response()->json(['message' => '新增成功'], 201);
    }

    #撈沒驗證的上傳資料
    public function getUnverifiedUploads()
    {
        return $this->statistics->getUnverifiedUploads();
    }

    #驗證上傳的資料
    public function verifyUserUploads(Request $request, string $verifyNumber)
    {
        #如果不是1也不是2回傳500
        if ($verifyNumber != '1' && $verifyNumber != '2') {
            return response()->json(['message' => '???'], 500);
        }

        $this->statistics->verifyUserUploads($request->id, $verifyNumber);

        #回傳204無任何內容
        return response()->noContent();
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
