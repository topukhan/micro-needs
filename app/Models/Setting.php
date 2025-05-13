<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'tab_slug',
        'tab_display_name',
        'field_key',
        'field_label',
        'field_value',
        'field_type',
        'placeholder',
        'hint',
    ];
}
