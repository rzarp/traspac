<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Officer extends Model
{
    public function golongan()
    {
        return $this->hasMany(FormOfficer::class, "golongan");
    }
    public function eselon()
    {
        return $this->hasMany(FormOfficer::class, "eselon");
    }
    public function jabatan()
    {
        return $this->hasMany(FormOfficer::class, "jabatan");
    }
}
