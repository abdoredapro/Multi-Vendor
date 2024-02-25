<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;

    public function abilities() {
        return $this->hasMany(RoleAbility::class);
    }
    public static function createWithAbilities(Request $request) {

        DB::beginTransaction();
        try {
            
            $role = Role::create([
                'name' => $request->post('name')
                ]);

            foreach($request->post('abilities') as $ability => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type' => $value,
                ]);
            }
            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }      

        return $role;
    }

    public function updateWithAbilities(Request $request) {

        DB::beginTransaction();
        try {
            
            $this->create([
            'name' => $request->post('name')
            ]);

            foreach($request->post('abilities') as $ability => $value) {
                RoleAbility::updateOrcreate([
                    'role_id' => $this->id,
                    'ability' => $ability,
                ],[
                    'type' => $value,
                ]);

            }

            DB::commit();

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }      

        return $this;
    }
}
