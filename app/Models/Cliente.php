<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property string $cedula
 * @property string $nombre
 * @property string $apellido
 * 
 * @property Collection|Compra[] $compras
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'cedula';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'cedula',
		'nombre',
		'apellido'
	];

	public function compras()
	{
		return $this->hasMany(Compra::class, 'cedula_cliente');
	}
}
