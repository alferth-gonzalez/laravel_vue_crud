<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','email','phone','document_number','address','city','status','notes'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Scope de filtros (search)
    public function scopeFilter($q, array $filters)
    {
        $search = $filters['search'] ?? null;

        $q->when($search, function ($qq) use ($search) {
            $qq->where(function ($w) use ($search) {
                $w->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('document_number', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        });
    }
}