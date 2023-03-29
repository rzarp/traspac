<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormOfficer extends Model
{
    public function golongan()
    {
        return $this->belongsTo(Officer::class, "golongan");
    }
    public function eselon()
    {
        return $this->belongsTo(Officer::class, "eselon");
    }
    public function jabatan()
    {
        return $this->belongsTo(Officer::class, "jabatan");
    }
}
