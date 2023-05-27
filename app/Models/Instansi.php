<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function status()
	{
		$status = [
			[
				'id' => 0,
				'name' => 'tidak aktif'
			],
			[
				'id' => 1,
				'name' => 'aktif'
			]
		];

		return $status;
	}
}
