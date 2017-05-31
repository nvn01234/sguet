<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * App\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
    protected $guarded = [];

    /**
     * Find a permission by its name.
     *
     * @param string $name
     *
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function findByName($name)
    {
        $permission = static::where('name', $name)->first();

        return $permission;
    }

    /**
     * @param array $ids
     * @return array
     */
    public function syncRoles($ids) {
        return $this->roles()->sync($ids);
    }
}
