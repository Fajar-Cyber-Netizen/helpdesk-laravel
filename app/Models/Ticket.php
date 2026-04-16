<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
      protected $fillable = [
      'ticket_no',
      'title',
      'description',
      'category',
      'status',
      'note',
      'user_id'
   ];
}