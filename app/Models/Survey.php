<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function feedback()
	{
		$feedback = [
			[
				'id' => 3,
				'name' => 'Sangat Puas'
			],
			[
				'id' => 2,
				'name' => 'Puas'
			],
			[
				'id' => 1,
				'name' => 'Cukup Puas'
			]
		];

		return $feedback;
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
