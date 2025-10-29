<?php

namespace App\Enums;

enum UserRolesType : string
{
    case Admin = 'admin';
    case Technician = 'technician';
}