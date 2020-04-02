<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /* Define relationship method */
    /* Question relationship */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /* User relationship */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body); 
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count');
            $answer->question->save();
        });
    }
}
