<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory;

  protected $fillable = ['tag' , 'tweet_id'];

  public function Tweets()
  {
    return $this->belongsTo(Tweet::class);
  }
}