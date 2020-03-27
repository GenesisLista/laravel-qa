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

    public function getUrlAttribute()
    {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /* This will format the date */
    public function getCreatedDateFormatAttribute()
    {
        return $this->created_at->format("d/m/Y");
    }

    /* This is for the Status */
    public function getStatusAttribute()
    {
        /* If the status is answered -> greater the zero value */
        if($this->answers > 0) {
            /* The best answer */
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        /* Else */
        return "unanswered";
    }

    /* This is for the show */
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body); 
    }
}
