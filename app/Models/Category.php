<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['category', 'team_id'])]
class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
