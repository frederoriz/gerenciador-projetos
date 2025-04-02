<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'end_date',
    ];
    
    protected $casts = [
        'end_date' => 'datetime',
    ];

    /**
     * Define a relação entre o projeto e as tarefas.
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
