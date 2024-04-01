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

    public function create(object $request)
    {
        try {
            #拿取文件物件->存到指定目錄->拿取圖片名稱
            $img = $request->file('img');
            $imgPath = $img->store('/public/images');
            $imgName = basename($imgPath);

            #新增上傳資料&回傳結果
            return $this->statistics->createStatistics($request, $imgName);

        } catch (\Exception $e) {
            return response()->json(['message' => '新增失敗,圖片儲存問題'], 500);
        }
    }
}
