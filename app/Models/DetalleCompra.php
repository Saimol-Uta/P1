<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DetalleCompra
 * 
 * @property int $id
 * @property int $id_compra
 * @property int $id_producto
 * @property int $cantidad
 * 
 * @property Compra $compra
 * @property Producto $producto
 *
 * @package App\Models
 */
class DetalleCompra extends Model
{
	protected $table = 'detalle_compras';
	public $timestamps = false;

	protected $casts = [
		'id_compra' => 'int',
		'id_producto' => 'int',
		'cantidad' => 'int'
	];

	protected $fillable = [
		'id_compra',
		'id_producto',
		'cantidad'
	];

	public function compra()
	{
		return $this->belongsTo(Compra::class, 'id_compra');
	}

	public function producto()
	{
		return $this->belongsTo(Producto::class, 'id_producto');
	}
}
