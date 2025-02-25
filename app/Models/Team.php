<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'members', 'event_id', 'user_id'];
    protected $table = 'teams';
    // Remove these lines if using auto-incrementing integer IDs
    // protected $primaryKey = 'id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public $timestamps = true;

    // Cast members to array when retrieving from database
    protected $casts = [
        'members' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Get all team members
    public function getTeamMembers()
    {
        if (is_string($this->members)) {
            return json_decode($this->members, true);
        }
        return $this->members;
    }

    // Check if a user is a member of this team
    public function isMember($userId)
    {
        return $this->enrollments()->where('user_id', $userId)->exists();
    }

    // Get the team leader (the user who created the team)
    public function getLeader()
    {
        return $this->user;
    }
}
