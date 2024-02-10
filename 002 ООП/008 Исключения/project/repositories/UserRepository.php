<?php

namespace App\repositories;

use App\entities\Entity;
use App\entities\UserEntity;

/**
 * @method UserEntity getEntityBase()
 */
class UserRepository extends Repository
{
    public function getEntityClass(): string
    {
        return UserEntity::class;
    }
}