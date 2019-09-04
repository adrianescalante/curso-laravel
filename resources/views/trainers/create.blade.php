@extends('layouts.app')

@section('title','Triners Create')

@section('content')

@include('common.errors')

	<form class="form-group" method="POST" action="/trainers" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label for="">Nombre</label>
			<input type="text" name="name" class="form-control">
		</div>

		<div class="form-group">
			<label for="">Avatar</label>
			<input type="file" name="avatar">
		</div>

		<button type="submit" class="btn btn-primary">Guardar</button>
	</form>

@endsection



<!--
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

	<div class="container">

		<div class="form-group">
		<label for="">Nombre</label>
		<input type="text" class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">Guardar</button>
		
	</div>

	

</body>
</html>

-->