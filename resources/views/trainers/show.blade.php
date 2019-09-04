@extends('layouts.app')

@section('title','Trainer')

@section('content')


@include('common.success')

				<div class="text-center">
					<img style="height: 120px; width: 120px; background-color: #EFEFEF; margin: 20px;" class="card-img-top rounded-circle mx-auto d-block" src="/images/{{$trainer->avatar}}">
						
					<h5 class="card-title">{{$trainer->name}}</h5>
					<p class="card-text">Información del entrenador</p>

					<a href="/trainers/{{$trainer->slug}}/edit" class="btn btn-primary">Editar</a>

					<p> </p>

				<!--
					formulario para eliminar
				-->
					 <form class="form-group" method="POST" action="/trainers/{{$trainer->slug}}">
        				@csrf
        				@method('DELETE')
        				<button type="submit" class="btn btn-danger">Eliminar</button>
    					</form>


					</div>

@endsection