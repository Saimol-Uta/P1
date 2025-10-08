<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $id
 * @property string $nombre
 * @property int $stock
 * 
 * @property Collection|DetalleCompra[] $detalle_compras
 *
 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'productos';
	public $timestamps = false;

	protected $casts = [
		'stock' => 'int'
	];

	protected $fillable = [
        'id',
		'nombre',
		'stock'
	];

	public function detalle_compras()
	{
		return $this->hasMany(DetalleCompra::class, 'id_producto');
	}
}
