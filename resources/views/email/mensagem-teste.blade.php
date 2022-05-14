@component('mail::message')
# Introções
Mensagem de Teste do envio de email por laravel

@component('mail::button', ['url' => ''])
Enviar
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
