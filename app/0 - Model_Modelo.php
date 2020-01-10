<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model {

    //The register will not be deleted in database, will be create the deleted_at
    // to crontrol this
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //
    // Relationships with others tables
    //
    public function patient() {
        // Relationship one-to-one with user model
        return $this->hasMany('App\Models\Painel\Patient', "health_insurance_id");
    }

    /**
     * 
     * @param type $searchCriteria
     * @param type $totalPage
     * @return type
     */
    public function searchGrid($searchCriteria, $totalPage) {

        $objs = $this->where(function($query_user) use($searchCriteria) {
                    // Pesquisando na tabela [User]
                    if (isset($searchCriteria['name']))
                        $query_user->where('name', 'like', "%{$searchCriteria['name']}%");
                })->orderBy('name')->paginate($totalPage);
        //->toSql();

        return $objs;
    }

}
