<?php
/**
 * Created by PhpStorm.
 * User: yushkevichv
 * Date: 14.09.2018
 * Time: 11:27
 */

namespace App;


class Role extends  \Spatie\Permission\Models\Role
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
}