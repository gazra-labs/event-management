<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $appends = ['title','start','end'];

    protected $fillable = ['name', 'start_time','end_time','user_id']; 

    public function getStartAttribute(){
        return $this->attributes['start_time'];
    }
    
    public function getEndAttribute(){
        return $this->attributes['end_time'];
    }
    
    public function getTitleAttribute(){
        return $this->attributes['name'];
    }
}
