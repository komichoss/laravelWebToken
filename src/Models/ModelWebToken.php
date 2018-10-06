<?php

namespace komicho\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelWebToken extends Model
{
    use SoftDeletes;

    protected $table = 'komicho_webtokens';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token',
        'token_key',
        'token_value',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
    public static function addValue($token, $key, $value)
    {
        $args['token'] = $token;
        $args['token_key'] = $key;
        $args['token_value'] = $value;
        self::create($args);
    }
    
    
    public static function updateValue($token, $key, $value)
    {
        $args['token_value'] = $value;
        self::where('token', '=', $token)->where('token_key', '=', $key)->update($args);
    }
    
    
    public static function getValue($token, $key)
    {
        return self::where('token', '=', $token)->where('token_key', '=', $key)->first()->token_value;
    }
    
    
    
    public static function exist($token, $key)
    {
        return self::where('token', '=', $token)->where('token_key', '=', $key)->exists();
    }
    
    public static function del($token, $key)
    {
        return self::where('token', '=', $token)->where('token_key', '=', $key)->delete();
    }
    
}
