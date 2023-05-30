<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['service'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function surveys() 
	{
	     return $this->hasMany(Survey::class);
	}
}
