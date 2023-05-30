<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function feedback()
	{
		$feedback = [
			[
				'id' => 1,
				'name' => 'Cukup Puas'
			],
			[
				'id' => 2,
				'name' => 'Puas'
			],
			[
				'id' => 3,
				'name' => 'Sangat Puas'
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
