	@extends ('layouts.main')
	@section('title', 'HDC -' .$event->title)

	@section('content')
	
			<div id="event-create-container" class="col-md-6 offset-md-3">
				<h1>Editando: {{ $event->title }}</h1>
				<form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data">
					@csrf
					@method('PUT')

					<div class="form-group">
						<label for="title">Evento:</label>
						<input id="title" name="title" type="text" class="form-control" placeholder="Nome do Evento" value="{{ $event->title }}">
					</div>
					<div class="form-group">
						<label for="date">Data do Evento:</label>
						<input id="date" name="date" type="date" class="form-control" value="{{ $event->date->format('Y-m-d') }}">
					</div>
					<div class="form-group">
						<label for="title">Cidade:</label>
						<input id="city" name="city" type="text" class="form-control" placeholder="Local do Evento" value="{{ $event->city }}">
					</div>
					<div class="form-group">
						<label for="title">O evento é privado?</label>
						<select id="private" name="private" class="form-control">
							<option value="0">Não</option>
							<option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
						</select>
					</div>
					<div class="form-group">
						<label for="title">Descrição:</label>
						<textarea id="description" name="description" class="form-control" placeholder="O que vai acontecer no evento?">{{ $event->description }}</textarea>
					</div>
					<div class="form-group">
						<label for="title">Adicione itens de infraestrutura:</label>
						<div class="form-group">
							<input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras
						</div>
						<div class="form-group">
							<input type="checkbox" name="items[]" value="Open Bar"> Open Bar
						</div>
						<div class="form-group">
							<input type="checkbox" name="items[]" value="Palco"> Palco
						</div>
						<div class="form-group">
							<input type="checkbox" name="items[]" value="Open Food"> Open Food
						</div>
						<div class="form-group">
							<input type="checkbox" name="items[]" value="Brindes"> Brindes
						</div>
					</div>



					<div class="form-group">
						<label for="image">Imagem do Evento:</label>
						<input id="image" name="image" type="file" class="form-control-file">
						<img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
					</div>
					<input type="submit" class="btn btn-primary" value="Editar Evento">
				</form>
			</div>
			

	

	@endsection	