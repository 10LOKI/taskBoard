<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Task extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title','description','deadline','priority','status','user_id'];
    
    protected $casts = [
        'deadline' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes for filtering
    public function scopeForUser($query, $userId = null)
    {
        return $query->where('user_id', $userId ?? Auth::id());
    }

    public function scopePending($query)
    {
        return $query->where('status', '!=', 'done');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', '!=', 'done')
                    ->where('deadline', '<', now())
                    ->whereNotNull('deadline');
    }

    // Business logic methods
    public function isOverdue(): bool
    {
        return $this->deadline && 
               $this->deadline->isPast() && 
               $this->status !== 'done';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'done';
    }

    public function markAsCompleted(): void
    {
        $this->update(['status' => 'done']);
    }

    public function setPriority(string $priority): void
    {
        $this->update(['priority' => $priority]);
    }

    public function setStatus(string $status): void
    {
        $this->update(['status' => $status]);
    }
}