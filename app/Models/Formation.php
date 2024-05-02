<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public function formationGrade()
    {
        return $this->belongsTo(FormationGrade::class, 'formationGrade_id');
    }
    
    public function subDomain()
    {
        return $this->belongsTo(SubDomain::class, 'subDomain_id');
    }
}
