<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Concerns\HasRoles;

class Admin extends User
{
    // This Table using for Admin Auth must extends User Auth
    // Not User model
    use HasFactory, Notifiable, HasApiTokens, HasRoles;
}
