<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pembayaran';
    protected $casts = ['tanggal_bayar' => 'datetime'];
    protected $with = ['user', 'tagihan'];


    /**
     * Get the tagihan that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Pembayaran::class);
    }

    protected static function booted()
    {
        static::creating(function ($tagihan) {
            $tagihan->user_id = Auth::user()->id;
        });

        static::updating(function ($tagihan) {
            $tagihan->user_id = Auth::user()->id;
        });
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
