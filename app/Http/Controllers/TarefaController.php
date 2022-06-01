<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use App\Exports\TarefasExportacao;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(8);
        return view('tarefa.index', ['tarefas' => $tarefas]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tarefa $tarefa)
    {
       $dados = $request->validate($tarefa->rules(),$tarefa->messages());

        $dados['user_id'] = auth()->user()->id;

        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email;

        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        
        return redirect()->route('tarefa.show',['tarefa'=> $tarefa->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        if ($tarefa->user_id == auth()->user()->id) {
            return view('tarefa.edite',['tarefa' => $tarefa]);
        }
        return view('acesso-negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        if (auth()->user()->id == $tarefa->user_id) {
            $tarefa->update($request->all());
            return redirect()->route('tarefa.show',$tarefa->id);
        }
        return view('acesso-negado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        if (auth()->user()->id == $tarefa->user_id) {
            $tarefa->delete();
            return redirect()->route('tarefa.index');
        }
        return view('acesso-negado');
    }
    public function exportacao($extensao)
    {
        switch ($extensao) {
            case 'xlsx':
                return Excel::download(new TarefasExportacao,'lista_de_tarefas.xlsx');
                break;
            case 'csv':
                return Excel::download(new TarefasExportacao,'lista_de_tarefas.csv');
                break;
            case 'pdf':
                return Excel::download(new TarefasExportacao,'lista_de_tarefas.pdf');
                break;
            default:
                return redirect()->route('tarefa.index');
                break;
        }
    }
    public function export()
    {
        $tarefas = auth()->user()->tarefa()->get();
        $pdf = PDF::loadView('tarefa.tarefa_pdf',['tarefas' => $tarefas]);
        return $pdf->stream('lista_tarefa.pdf');      
    }

}
