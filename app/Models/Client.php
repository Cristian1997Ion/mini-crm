<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property boolean $avatar
 */
class Client extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * One-To-Many Relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
