<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', 'address_line1', 'address_line2',
        'state', 'country', 'pin_code', 'type'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
