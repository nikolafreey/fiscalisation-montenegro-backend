<?php

namespace App\Models;

use App\RobaAtributRobeIndexConfigurator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use ScoutElastic\Searchable;

class RobaAtributRobe extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['roba_id', 'atribut_id'];

    protected $table = 'robe_atributi_roba';

    use Searchable;

    protected $indexConfigurator = RobaAtributRobeIndexConfigurator::class;

    protected $searchRules = [
        //
    ];

    protected $mapping = [
        'properties' => [
            'naziv' => [
                'type' => 'text',
            ],
            'atribut_id' => [
                'type' => 'keyword'
            ],
            'tip_atributa_id' => [
                'type' => 'keyword'
            ]
        ]
    ];

    public static function filter(Request $request) {
        if ($request->has('search')) {
            return RobaAtributRobe::filterElastic($request);
        }
        $query = RobaAtributRobe::query();
        if($request->has('tip_atributa_id')) {
          $query = $query->whereHas('atribut_robe', function ($query) use ($request) {
              $query->where('tip_atributa_id', $request->tip_atributa_id);
          });
        }
        if($request->has('atribut_id')){
            $query = $query->whereHas('atribut_robe', function ($query) use ($request) {
                $query->where('robe_atributi_roba.atribut_id', $request->atribut_id);
            });
        }
        return $query;
    }

    private static function filterElastic(Request $request) {
        $query = RobaAtributRobe::search($request->search . '*');
        if($request->has('tip_atributa_id')) {
            $query = $query->where('tip_atributa_id', $request->tip_atributa_id);
        }
        if($request->has('atribut_id')){
            $query = $query->where('atribut_id', $request->tip_atributa_id);
        }
        return $query;
}

    public function toSearchableArray()
    {
        $array['naziv'] = $this->roba->naziv;
        $array['atribut_id'] = $this->atribut_id;
        $array['tip_atributa_id'] = $this->atribut_robe->id;

        return $array;
    }

    public function roba()
    {
        return $this->belongsTo('App\Models\Roba', 'roba_id');
    }
    public function atribut_robe()
    {
        return $this->belongsTo('App\Models\AtributRobe', 'atribut_id');
    }
}
