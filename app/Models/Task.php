<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'status',
        'project_id',
    ];

    /**
     * Define a relação entre a tarefa e o projeto.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
