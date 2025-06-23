<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'roll_no',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

public function isTeamLeader($teamId)
{
    $team = Team::find($teamId);
    if (!$team) {
        
        return false;
    }
    
    // Decode the JSON string into an array
    $members = json_decode($team->members, true);
    
    // Check if json_decode failed
    if (json_last_error() !== JSON_ERROR_NONE) {
        
        return false;
    }
    
    if (empty($members) || !is_array($members)) {
        
        return false;
    }
    
    // Check if the first member's roll number matches the user's roll number
    
    
    return $members[0] === $this->roll_no;
    }
    public function adminEvents()
    {
        return $this->hasMany(EventAdmin::class);
    }
    public function isEventAdmin($eventId)
    {
        return $this->adminEvents()->where('event_id', $eventId)->exists();
    }
    public function isAdmin()
    {
        return $this->is_super;
    }
    public function isEventAdmin1()
    {
        return $this->is_admin;
    }
}
