@component('mail::message')
Kedves {{$info["name"]}}, 

Sikeresen rendelés.
- Szállítási cím: {{$info["address"]}}

Köszöntettel, PizzaWeb<br>
@endcomponent
