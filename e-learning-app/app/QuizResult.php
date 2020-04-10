<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
  protected $fillable = ['quiz_id', 'user_id', 'quiz_result', 'total'];



}
