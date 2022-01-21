<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $fillable=['designation_id'];

    public function designations(){
        return $this->belongsTo(Designations::class,'designation_id');
    }
}
