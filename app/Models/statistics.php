<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class statistics extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'count', 'decay', 'image', 'type', 'ip'];

    public function getCountData()
    {
        return statistics::selectRaw('COUNT(id) as user_count')
            ->selectRaw('SUM(count) as sum')
            ->selectRaw('SUM(decay) as sum_decay')
            ->selectRaw('(SUM(decay)/SUM(count))*100 as probability_decay')
            ->where('type', 1)
            ->first();
    }

    public function getUserData()
    {
        return Statistics::select('name')
            ->selectRaw('SUM(count) as count')
            ->selectRaw('SUM(decay) as decay')
            ->selectRaw('(SUM(decay) / SUM(count)) * 100 as probability')
            ->where('type', 1)
            ->groupBy('name')
            ->orderByDesc('count')
            ->get();
    }

    public function createStatistics(object $request, string $imgName)
    {
        return Statistics::create([
            'name' => $request->name,
            'count' => $request->count,
            'decay' => $request->decay,
            'image' => '/storage/images/' . $imgName,
            'type' => 0,
            'ip' => $request->ip(),
        ]);
    }

    #拿未驗證上傳資料
    public function getUnverifiedUploads()
    {
        return Statistics::select('id', 'name', 'count', 'decay', DB::raw("CONCAT('" . env('HOST_DNS') . "', image) AS image"), 'ip', 'updated_at')
            ->where('type', 0)
            ->get();
    }

    #驗證上傳資料
    public function verifyUserUploads(string $id, string $type)
    {
        return Statistics::where('id', $id)
            ->update(['type' => $type]);
    }



    #下列2個應該用不到但先放著
    public function getMaxCountUser()
    {
        return Statistics::select('name')
            ->selectRaw('SUM(count) as count')
            ->where('type', 1)
            ->groupBy('name')
            ->orderByDesc('count')
            ->first();
    }

    public function getLuckyUser()
    {
        return Statistics::select('name')
            ->selectRaw('(SUM(decay) / SUM(count)) * 100 as probability')
            ->where('type', 1)
            ->groupBy('name')
            ->orderByDesc('probability')
            ->first();
    }
}
