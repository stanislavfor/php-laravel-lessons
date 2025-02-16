<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_users'; // Здесь явно указывается имя таблицы

    protected $fillable = ['name', 'surname', 'email'];
}

