<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExportacao implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return auth()->user()->tarefa()->get();
    }
    public function headings():array
    {
        return [
            'ID Tarefas',
            'Tarefa',
            'Data limite conclusão',
        ];
    }
    public function map($tarefa): array
    {
        return [
            $tarefa->id,
            $tarefa->tarefa,
            $tarefa->data_limite_conclusao
        ];
    }

}
