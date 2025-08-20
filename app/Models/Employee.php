<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'department_id', 'status'];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }
    
    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
