<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
	public $table = 'proveedor';

	public $fillable = [
		'Nombre'
	]
	;
	public $timestamps = false;
}
