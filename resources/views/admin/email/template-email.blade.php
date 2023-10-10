<h4>Добрый день, {{$email->first_name}} {{$email->last_name}}</h4>
<p>
    С Вами на связи {{auth()->user()->name}}.
    {{$text}}
</p>
