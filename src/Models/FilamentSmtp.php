<?php

namespace TheNightOwl\FilamentSmtp\Models;

use Illuminate\Database\Eloquent\Model;

class FilamentSmtp extends Model
{
    protected $table;

    public function __construct() 
    {
        $this->table = config('filament-smtp.table_name');
    }

    protected $fillable = [
        'user_id',
        'driver',
        'host',
        'port',
        'encryption',
        'username',
        'password',
        'from_address',
        'from_name',
        'refresh_token',
        'is_default'
    ];

    protected $casts = [
        'is_default' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

}