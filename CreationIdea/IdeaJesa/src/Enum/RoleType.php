<?php
namespace App\Enum;

enum RoleType: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case CUSTOMER = 'customer';
}
