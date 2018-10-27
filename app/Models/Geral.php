<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Geral extends Model
{

    public function scopeFiltrar($query, $request) {
        if ($request->has('filter')) {
            $filtro = json_decode($request->input('filter'));
            $oldQuery = clone $query;
            $dates = $oldQuery->getModel()->getDates();
            foreach ($filtro as $key => $value) {
                $dotIndex = strpos($key, ".");
                if($dotIndex != false) {
                    $newKey = explode(".", $key);
                    $query = $query->whereHas($newKey[0], function($newQuery) use ($newKey, $dates, $value) {
                        $newQuery = $this->whereFiltrar($newQuery, $newKey[1], $dates, $value);
                    });
                } else {
                    $query = $this->whereFiltrar($query, $key, $dates, $value);
                }
                
            }
        }
        if($request->has('with')) {
            $with = json_decode($request->input('with'));
            if(is_array($with)) {
                foreach ($with as $key => $value) {
                    if(is_string($value)) {
                        $query = $query->with($value);
                    }
                }
            } else {
                $query = $query->with($with);
            }
        }
        
        return $query;
    }
    private function whereFiltrar(&$query, $key, $dates, $value) {
        if(in_array($key, $dates)) {
            $query = $query->whereDate($key, Carbon::parse($value)->toDateString());
        } else if(is_string($value) || is_numeric($value)) {
            $query = $query->where($key, $value);
        } else if(is_array($value)) {
            $query = $query->whereIn($key, $value);
        }
        return $query;
    }

    public static function preAdicionar($model) {

    }
    public static function posAdicionar($model) {

    }
    public static function preAtualizar($model) {

    }
    public static function posAtualizar($model) {

    }
    public static function preDeletar($model) {

    }
    public static function posDeletar($model) {

    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model){
            static::preAdicionar($model);
        });

        static::created(function($model){
            static::posAdicionar($model);
        });

        static::updating(function($model){
            static::preAtualizar($model);
        });

        static::updated(function($model){
            static::posAtualizar($model);
        });

        static::deleting(function($model){
            static::preDeletar($model);
        });

        static::deleted(function($model) {
            static::posDeletar($model);
        });
    }
}
