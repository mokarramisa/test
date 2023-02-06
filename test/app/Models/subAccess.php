<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subAccess extends Model
{
    use HasFactory;

    public function access ()
    {
        return $this->belongsTo(Access::class);
    }
}
