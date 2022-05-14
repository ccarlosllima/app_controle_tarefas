@component('mail::message')
# {{$tarefa}}

Data Limite Conclusão {{$data_limite_conclusao}}
@component('mail::button', ['url' => $url])
Click aqui para ver a tarefa
@endcomponent

Obrigado<br>
{{ config('app.name') }}
@endcomponent
