<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistics extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'count', 'decay', 'image', 'type', 'ip'];

    public function showIndex()
    {
        return statistics::all();
    }

    public function getCountData()
    {
        return statistics::selectRaw('COUNT(id) as user')
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
