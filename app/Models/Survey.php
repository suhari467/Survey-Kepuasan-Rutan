<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenis()
	{
		$jenis = [
			[
				'id' => 1,
				'name' => 'Kurang'
			],
			[
				'id' => 2,
				'name' => 'Cukup'
			],
			[
				'id' => 3,
				'name' => 'Baik'
			]
		];

		return $jenis;
	}

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
