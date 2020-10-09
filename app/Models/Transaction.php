<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 *
 * @property integer $id
 * @property integer $client_id
 * @property string  $transaction_date
 * @property float   $amount
 */
class Transaction extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Many-To-One Relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
