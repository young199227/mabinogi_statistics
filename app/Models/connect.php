<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connect extends Model
{
    use HasFactory;

    protected $fillable = ['ip', 'type'];

    public function createConnect(string $ip): Model
    {
        return connect::create([
            'ip' => $ip,
            'type' => 1,
        ]);
    }
}
