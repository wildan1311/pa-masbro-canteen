<?php

namespace App\Models\Konfigurrasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $guard = ['id'];

    public function subMenus(){
        return $this->hasMany(Menu::class, 'main_menu_id');
    }
}
