<?php

namespace App\Models;

use App\Space\Contracts\HasOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole implements HasOption
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getOptionValue(): string
    {
        return $this->id;
    }

    public function getOptionText(): string
    {
        return $this->name;
    }
}
