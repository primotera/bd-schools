<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationGrade extends Model
{
    use HasFactory;

    public function formation()
    {
        return $this->hasMany(Formation::class);
    }
}
