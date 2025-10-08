<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Compra
 * 
 * @property int $id
 * @property string $cedula_cliente
 * @property Carbon|null $fecha_compra
 * 
 * @property Cliente $cliente
 * @property Collection|DetalleCompra[] $detalle_compras
 *
 * @package App\Models
 */
class Compra extends Model
{
	protected $table = 'compras';
	public $timestamps = false;

	protected $casts = [
		'fecha_compra' => 'datetime'
	];

	protected $fillable = [
		'cedula_cliente',
		'fecha_compra'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'cedula_cliente');
	}

	public function detalle_compras()
	{
		return $this->hasMany(DetalleCompra::class, 'id_compra');
	}
}
