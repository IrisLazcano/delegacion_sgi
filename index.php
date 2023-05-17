<!DOCTYPE html>
<html>
	<head>
		<title>CONTROL DE DOCUMENTOS</title>
		
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" >
		<link rel="stylesheet" href="css/estilos_index.css">
		<script src="js/bootstrap.min.js" ></script>
		
	</head>
	
	<body>
	<header>
      <!--logo-->
	</header>
	<div class="container">    
			          
	 				 
											    
					
					<div style="padding-top:30px" class="panel-body" >
						
						<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
						
	<form action="login.php" method="POST" autocomplete="off">
							
							<div class="panel-title">
								<h4>Iniciar Sesión</h4></div>
								
							<div style="margin-bottom: 25px" class="input-group">
								<input id="usuario" type="text" class="form-control" name="usuario" value="" placeholder="Ingresa tu Clave de Servidor Publico" required>                                        
							</div>
							
							<div style="margin-bottom: 25px" class="input-group">
								<input id="password" type="password" class="form-control" name="password" placeholder="Ingresa Contraseña" required>
							</div>
							
							<div style="margin-top:10px" class="form-group">
								<div class="col-sm-12 controls">
									<button id="btn-login" type="submit" class="btn btn-success">Iniciar Sesión</a>
								</div>
							</div>
							</div>
							
							</div>    
						</form>
					</div>                     
				</div>  
	</body>
	</html>				