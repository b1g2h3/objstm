@component('mail::message')
# Objednávka č.{{$order->id}}
# byla vytvořena od  {{$user->invoice->nazev}}

Poznámka
{{$order->description}}

<h5>Fakturacni udaje</h5>
<div>Název: {{$user->invoice->nazev}}</div>
<div>Ulice: {{$user->invoice->ulice}}</div>
<div>Město: {{$user->invoice->mesto}}</div>
<div>Psč: {{$user->invoice->psc}}</div>
<div>Země: {{$user->invoice->zeme}}</div>
<div>IC: {{$user->invoice->ic}}</div>
<div>DIC: {{$user->invoice->dic}}</div>
@component('mail::button', ['url' => $url , 'color' => 'success'])
Objednávku si můžete prohlednout zde.
@endcomponent

@component('mail::table')
| Produkt       | Hmotnost         | Množství  |
| ------------- |:-------------:| --------:|
@foreach ($order->amounts as $item)
| {{$item->product->name}}     | {{$item->product->hmotnost}}     | {{$item->mnozstvi}}      |
@endforeach
@endcomponent

@endcomponent
