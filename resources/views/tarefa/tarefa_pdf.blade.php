<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .page-break {
            page-break-after: always;
        }   
        .titulo{
            border:1px;
            background-color: darkgray;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .tabela{
            width: 100%; 
        }
        table,th{
            text-align: left;
        }
    </style>

</head>
<body>
    <h1 class="titulo" >Listagem das Tarefas</h1>

<table class="tabela">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tarefa</th>
            <th>Data limtie conclusão</th>
        </tr>
    </thead>

    <tbody>
        
        @foreach($tarefas as $tarefa)
            <tr>
                <td>{{$tarefa->id}}</td>
                <td>{{$tarefa->tarefa}}</td>
                <td>{{$tarefa->data_limite_conclusao}}</td>
            </tr>
        @endforeach
    </tbody>
</table> 
<div class="page-break"></div>
<h2>pagina 2</h2>
<div class="page-break"></div>       
<h2>pg 3</h2>
<div class="page-break"></div>       

</body>
</html>