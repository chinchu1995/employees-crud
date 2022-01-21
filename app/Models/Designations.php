<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designations extends Model
{
    use HasFactory;

    public function employees(){
        return $this->hasMany(Employees::class,'designation_id');
    }
}
