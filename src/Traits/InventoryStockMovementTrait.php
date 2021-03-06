<?php

namespace Stevebauman\Inventory\Traits;

use Stevebauman\Inventory\Helper;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait InventoryStockMovementTrait
 *
 * @package Stevebauman\Inventory\Traits
 * @version 1.9.4
 */
trait InventoryStockMovementTrait
{
    use DatabaseTransactionTrait,
        UserIdentificationTrait;

    /**
     * The belongsTo stock relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    abstract public function stock();

    /**
     * Overrides the models boot function to set
     * the user ID automatically to every new record.
     *
     * @return void
     */
    public static function bootInventoryStockMovementTrait()
    {
        static::creating(function (Model $record) {
            $record->{static::getForeignUserKey()} = static::getCurrentUserId();
        });
    }

    /**
     * Rolls back the current movement.
     *
     * @param bool $recursive
     *
     * @return mixed
     */
    public function rollback($recursive = false)
    {
        return $this->stock->rollback($this, $recursive);
    }
}
