<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;
    protected $fillable = ['tarefa','data_limite_conclusao','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // Método responsável por definir as regaras de validações
    public function rules()
    {
        return [
            'tarefa' => 'required|min:5',
            'data_limite_conclusao' => 'required',        
        ];
    }

    // Método responsável por configurar as mensagens de validações.
    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'tarefa.min' => 'A tarefa deve conter no mínimo 5 caracteres!'
        ];
    }
}
