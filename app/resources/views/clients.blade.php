@extends('layouts.app')

@section('breadcrumbs')
    <li class="breadcrumb-item">
        <a href="/">Форма заказа</a>
    </li>
@endsection

@section('content')
    <h1>Клиенты</h1>

	@if(!$clients->count())
	<h4>Пока клиентов нет...</h4>
	@endif

	@foreach($clients as $client)
		<div>
			<strong>{{$client->name}}</strong>
			<small>#{{$client->id}}</small>
		</div>

		<div>
			Телефон: {{$client->phone}}
		</div>
		<br>
		<strong>Заказы:</strong>
		@foreach($client->tariffs as $tariff)
			<br>
			<div>
				Тариф {{$tariff->name}}
				(${{$tariff->price}}) 
				заказан
				{{$tariff->pivot->created_at}} 
				<br>
				Первый день доставки:
				@switch($tariff->pivot->first_day)
				    @case(1)
				        Понедельник
				        @break
				    @case(2)
				        Вторник
				        @break
				    @case(3)
				        Среда
				        @break
				    @case(4)
				        Четверг
				        @break
				    @case(5)
				        Пятница
				        @break
				    @case(6)
				        Суббота
				        @break
				    @case(7)
				        Воскресенье
				        @break
				@endswitch
				<br>
				Адрес доставки:
				{{$tariff->pivot->address}}
			</div>
		@endforeach

		<hr>
	@endforeach
@endsection
