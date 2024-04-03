<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class connect extends Model
{
    use HasApiTokens;
    use HasFactory;

    protected $fillable = ['ip', 'token', 'type'];

    public function createConnect(string $ip): string
    {
        #刪除5分鐘前的token
        Connect::where('created_at', '<', Carbon::now()->subMinutes(5))->delete();

        $token = Str::random(64);

        connect::create([
            'ip' => $ip,
            'token' => $token,
            'type' => 1,
        ]);
        return $token;
    }
}
