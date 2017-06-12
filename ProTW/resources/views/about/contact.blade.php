@extends('layouts.app')

@section('content')

	<h1>Contact</h1>

	<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

	{!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}

	<div class="form-group">
		{!! Form::label('Your Name') !!}
		{!! Form::text('name', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your name')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('Your E-mail Address') !!}
		{!! Form::text('email', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address')) !!}
	</div>

	<div class="form-group">
		{!! Form::label('Your Message') !!}
		{!! Form::textarea('message', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your message')) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Contact Us!',
          array('class'=>'btn btn-primary')) !!}
	</div>
	{!! Form::close() !!}

@endsection

<style type="text/css">
	h1 {
		text-align: center;
	}
	@media (min-width:769px) {
		h1 {
			padding: 0 40px;
		}
		form {
			position: fixed;
			top: 50%;
			left: 50%;
			bottom: 0;
			width: 600px;
			height: 500px;
			padding: 40px;
			transform: translate(-50%,-50%);
			background-color: rgba(255, 255, 255, 0.7);
			border-radius: 6px;
		}
		form input, form textarea {
			max-width: 60%;
		}

		form .btn {
			transition: background .3s ease-in-out;
		}
	}
	/* responsive */
	@media (max-width:768px) {
		form {
			padding: 0 20px;
		}
		form input, form textarea {
			max-width: 100%;
		}
		form .form-group:last-child {
			text-align: center;
		}
	}
</style>