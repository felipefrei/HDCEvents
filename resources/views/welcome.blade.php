	@extends ('layouts.main')
	@section('title', 'HDC Events')

	@section('content')
		<div id="search-container" class="col-md-12">
			<h1> Busque um evento</h1>
			<form action="/" method="GET">
				<input id="search" type="text" name="search" class="form-control" placeholder="Nome / trecho / palavra chave">
			</form>
		</div>

		<div id="events-container" class="col-md-12">
			@if($search)
				<h1>Buscando por: {{ $search }}</h1>
			@else
				<h1>Próximos Eventos</h1>
				<p class="subtitle">Veja os eventos dos próximos dias </p>
			@endif  
			
			<div id="cards-container" class="row">
				@foreach($events as $event)
					<div class="card col-md-3">
						<img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}">
						<div class="card-body">
							<p class="card-date"> {{ date('d/m/Y', strtotime($event->date)) }}</p>
							<h5 class="card-title">{{ $event->title }}</h5>
							<p class="card-participants"> {{count($event->users)}}&nbsp;Participante(s) Confirmado(s)</p>
							<a href="/events/{{ $event->id }}" class="btn btn-primary">Saber Mais</a>
						</div>
					</div>
				@endforeach
				@if(count($events) == 0 && $search)
					<p>Não foi possível encontar nenhum evento com: {{ $search }}! <a href="/">Ver todos</a></p>
				@elseif(count($events) == 0)
					<p>Não há eventos disponíveis</p>
				@endif  
			</div>
		</div>


		
		
	@endsection 
