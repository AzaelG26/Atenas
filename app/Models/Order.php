<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'orders';

    // Clave primaria personalizada
    protected $primaryKey = 'id_order';

    // Indicar si la clave primaria es auto-incremental
    public $incrementing = true;

    // Tipo de datos de la clave primaria (int o string)
    protected $keyType = 'int';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'diner_name',
        'total_price',
        'status',
        'id_employee',
        'id_payment',
        'id_folio',
    ];

    // Deshabilitar timestamps si no existen en la tabla
    public $timestamps = true;

    // Relación uno a muchos con OrderDetail
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'id_order');
    }

    // Relación uno a uno con Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'id_employee', 'id_employee');
    }

    // Relación uno a uno con Payment
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment', 'id_payment');
    }

    // Relación uno a uno con Folio
    public function folio()
    {
        return $this->belongsTo(Folio::class, 'id_folio', 'id_folio');
    }

    // Accesor para formatear el precio total
    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2);
    }

    // Accesor para el estado con formato capitalizado
    public function getFormattedStatusAttribute()
    {
        return ucfirst($this->status);
    }

    // Scope para filtrar órdenes por estado
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope para órdenes recientes
    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->take($limit);
    }
}
