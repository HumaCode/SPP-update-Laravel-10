<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;

class Biaya extends Model
{
    use HasFactory, HasFormatRupiah, SearchableTrait;

    protected $guarded = [];
    protected $table = 'biaya';
    protected $append = ['nama_biaya_full'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'nama' => 10,
            'jumlah' => 10,
        ]
    ];

    protected function namaBiayaFull(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->nama . '  -  ' . $this->formatRupiah('jumlah'),
        );
    }

    /**
     * Get the user that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($biaya) {
            $biaya->user_id = Auth::user()->id;
        });

        static::updating(function ($biaya) {
            $biaya->user_id = Auth::user()->id;
        });
    }
}
