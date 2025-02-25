<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'events';

    // Define the primary key
    protected $primaryKey = 'id';

    // Set incrementing to false if primary key is not auto-incrementing
    public $incrementing = false;

    // Define the data type of the primary key
    protected $keyType = 'string';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'id', 'eventName', 'eventDetails', 'entryFees',
        'eventCategory', 'eventDay', 'startTime', 'endTime',
        'maxSeats', 'teamSize', 'whatsapp', 'isFeatured', 'dept'
    ];
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function admins()
    {
        return $this->hasMany(EventAdmin::class);
    }
}
