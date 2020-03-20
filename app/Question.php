<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /* This values are from the question from database (questions_table.php) */
    protected $fillable = ['title', 'body'];

    /* This is a relationship method for the user model (User.php) */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

}
