<?php

namespace App\Models;

use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasFactory;
}
