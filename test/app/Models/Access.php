<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Access extends Model
{
    use HasFactory;

    public function permissions ()
    {
        return $this->hasMany(Permission::class);
    }

    public function storeAccess (Request $request, $access_id)
    {
        Permission::create([
            'name' => Access::where('id', $access_id)->first('access_name'),
        ]);
    }

    public function showAccess ()
    {
        return Access::all();
    }

    public function subAccess ()
    {
        return $this->hasMany(Access::class);
    }

}
