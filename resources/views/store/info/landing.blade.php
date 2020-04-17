<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<link rel="icon" type="image/png" href="{{ asset('img/logos/ico2.png') }}" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<title>Bitstore - landing </title>
</head>
<body style="background-color: #030303">
	<div class="container">
		<div class="row justify-content-center pt-5 mb-3">
			<div class="col-md-6">
				<img class="img-fluid" src="{{ asset('img/logos/logo4.png') }}" alt="">
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<p class="h1 font-weight-normal text-white text-break">Participa en el reto que tenemos para tí</p>
				<p class="text-white">Completa el reto 2048, comparte una captura con el reto completado en nuestra fanpage y podras obtener un descuento incríble en tu primera compra.</p>
				<a href="{{ route('juego') }}" class="btn btn-lg btn-outline-warning ">¡Jugar ahora!</a>
				<div class="w-100"></div>
				<img class="mt-3 img-fluid" src="{{ asset('img/locales/m2.svg') }}" style="height: 150px" >
			</div>
		</div>
	</div>
	 <!-- Footer -->
	<footer class="container fixed-bottom pt-5">	    
	    <!-- Copyright -->
	    <hr class="bg-white">
	    <div class="footer-copyright text-center pb-2 text-white"><small>© 2020 Copyright:
	        <a href="bitstoresv.com"> Bitstore.com</a>	</small>
	    </div>
	    <!-- Copyright -->
	</footer>
	<!-- Footer -->
	
</body>
</html>