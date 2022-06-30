	@extends ('layouts.main')
	@section('title', 'HDC - Criar Evento')

	@section('content')
	
			<div id="event-create-container" class="col-md-6 offset-md-3">
				<h1>Crie o seu Evento</h1>
				<form action="/events" method="POST" enctype="multipart/form-data">
					@csrf

					<div class="form-group">
						<label for="title">Evento:</label>
						<input id="title" name="title" type="text" class="form-control" placeholder="Nome do Evento">
					</div>
					<div class="form-group">
						<label for="date">Data do Evento:</label>
						<input id="date" name="date" type="date" class="form-control">
					</div>
					<div class="form-group">
						<label for="title">Cidade:</label>
						<input id="city" name="city" type="text" class="form-control" placeholder="Local do Evento">
					</div>
					<div class="form-group">
						<label for="title">O evento é privado?</label>
						<select id="private" name="private" class="form-control">
							<option value="0">Não</option>
							<option value="1">Sim</option>
						</select>
					</div>
					<div class="form-group">
						<label for="title">Descrição:</label>
						<textarea id="description" name="description" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
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
					</div>
					<input type="submit" class="btn btn-primary" value="Criar Evento">
				</form>
			</div>
			

	

	@endsection	