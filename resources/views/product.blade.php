	@extends ('layouts.main')
	@section('title', 'HDC - Produto')

	@section('content')
		@if($id != null)
			<h1> View de Produto unico </h1>
			<p> Produto de id: {{$id}}</p>
		@else
			<p>Seu Produto não foi encontrado </p>
			<div>
				<img src="/img/4.webp" alt="Pruduto não encontrado">
			</div>
		@endif	


	

	@endsection	
