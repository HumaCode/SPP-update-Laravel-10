<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliBank extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'wali_bank';
    protected $append = ['nama_bank_full'];


    protected function namaBankFull(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->nama_bank . ' - An. ' . $this->nama_rekening . ' (' . $this->nomor_rekening . ')',
        );
    }
}
