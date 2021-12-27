<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    protected $hidden = ['pivot'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
