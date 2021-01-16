@component('mail::message')

<h1>Olá, {{ $nome }}, te enviamos um documento, clique no botão abaixo para acessar nosso painel e fazer download</h1>
@component('mail::button', ['url' => 'www.nunotech.com.br/certus/daniel/public'])
    FAZER DOWNLOAD
@endcomponent
@endcomponent
