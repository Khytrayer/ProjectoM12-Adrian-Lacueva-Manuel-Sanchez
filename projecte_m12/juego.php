<?php
  session_start();

  require 'login/database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password, pato FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cllicking Duck</title>
	<meta charset="utf-8">
	<link href="estilos/estilosWeb.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="imagenes/favicon.png" type="image/png">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<script src="scripts/script.js"></script>

	<header>
		<div class="conect">
			<?php if(!empty($user)): ?>
			      <?= $user['email']; ?>
				<div class="conecta">
			      <a href="/projecte_m12/login/logout.php">DESCONEXIÓN</a>
			    <?php else: ?>
				<div class="conecta">
			      <a href="/projecte_m12/login/login.php">CONEXIÓN</a>
			    <?php endif; ?>
			</div>
		</div>
		<div class="nav">
  			<div id="home"><a href="/projecte_m12/login/logout.php"><img src="imagenes/logofoot.png" height="50px"></a></div>
		</div>	
	</header>


	<h1>CLICKING DUCK</h1>

	<div class="cajajuego">

		<div class="contenido">
			<img src="imagenes/pato.png" width="400px" id="patoclick"  onclick="clic()">
		</div>

		<div class="info">
			<h3 id="nombrepato">EL PATO <span id="nombrePato">
				<?php if(!empty($user)): ?>
			    	<?= $user['pato']; ?>
			    	<?php else: ?>
					Anónimo
			    <?php endif; ?>
			    <span></h3>
			<p id="cuacks"></p>
			<p id="cuackseg"></p>
			<p id="poderclic"></p>
			<p id="poderejercito" hidden="true"></p>
		</div>

	</div>	

	<div class="mejoras">

		<div class="tab">
	  		<button class="tablinks" onclick="abrirMenu(event, 'Terrenos')">TERRENOS</button>
	  		<button class="tablinks" onclick="abrirMenu(event, 'Artefactos')">ARTEFACTOS</button>
	  		<button class="tablinks" onclick="abrirMenu(event, 'Estadisticas')">ESTADÍSTICAS</button>
	  		<button class="tablinks" onclick="abrirMenu(event, 'Logros')">LOGROS</button>
	  		<button class="tablinks" onclick="abrirMenu(event, 'Expediciones')" id="tabExpediciones" hidden="true" >EXPEDICIONES</button>
		</div>

		<div id="Terrenos" class="tabcontent">
	 	  
			<table class="tablascompra">
				<tr id="trpter">
					<th>PROCEDENCIA</th>
					<th>DESCRIPCIÓN</th>
					<th>PRECIO (C)</th>
					<th>PROPIEDAD</th>
					<th>PRODUCCIÓN</th>
					<th></th>
				</tr>
				<tr id="charca">
					<td>CHARCA</td>
					<td>Un <span class="nompato">Pato Charcoso</span> que genera <span class="nomcuack">1 Cuack/s</span></td>
					<td id="preCha"></td>
					<td id="canCha"></td>
					<td id="proCha"></td>
					<td><button class="botoncompra" onclick="comprar(0)">Comprar</button></td>
				</tr>
				<tr>
					<td>LAGO</td>
					<td>Un <span class="nompato">Pato de Lago</span> que genera <span class="nomcuack">3 Cuack/s</span></td>
					<td id="preLag"></td>
					<td id="canLag"></td>
					<td id="proLag"></td>
					<td><button class="botoncompra" onclick="comprar(1)">Comprar</button></td>
				</tr>
				<tr>
					<td>PLAYA</td>
					<td>Un <span class="nompato">Pato Turístico</span> que genera <span class="nomcuack" id="cuackPlaya">5 Cuack/s</span></td>
					<td id="prePla"></td>
					<td id="canPla"></td>
					<td id="proPla"></td>
					<td><button class="botoncompra" onclick="comprar(2)">Comprar</button></td>
				</tr>
				<tr id="piscina" hidden="true">
					<td>PISCINA</td>
					<td>Un <span class="nompato">Pato Piscinero</span> que genera <span class="nomcuack" id="cuackPlaya">2 Cuack/s</span>. Llenar la piscina otorga 1 Poder de Click</td>
					<td id="prePis"></td>
					<td id="canPis"></td>
					<td id="proPis"></td>
					<td><button class="botoncompra" id="botoncomprapiscina"onclick="comprar(7)">Comprar</button></td>
				</tr>
				<tr>
					<td>GRANJA</td>
					<td>Un <span class="nompato">Pato Campesino</span> que genera <span class="nomcuack"> 2 Cuack/s</span> por cada <span class="nompato">Pato de Lago</span> en tu dominio</td>
					<td id="preGra"></td>
					<td id="canGra"></td>
					<td id="proGra"></td>
					<td><button type="button" class="botoncompra" onclick="comprar(3)">Comprar</button></td>
				</tr>
				<tr id="castillo" hidden="true">
					<td >CASTILLO</td>
					<td>Un <span class="nompato">Pato Guerrero</span> que  consume <span class="nomcuack">5% Cuacks/s</span> de la Producción, pero puede ser muy útil</td>
					<td id="preGue"></td>
					<td id="canGue"></td>
					<td id="proGue"></td>
					<td><button class="botoncompra" id="botoncompracastillo" onclick="comprar(4)">Comprar</button></td>
				</tr>
				<tr>
					<td>ESPACIO</td>
					<td>Un <span class="nompato">Pato astronauta</span> que genera <span class="nomcuack">200 Cuack/s</span></td>
					<td id="preAst"></td>
					<td id="canAst"></td>
					<td id="proAst"></td>
					<td><button class="botoncompra" onclick="comprar(5)">Comprar</button></td>
				</tr>
				<tr>
					<td>OLÍMPO</td>
					<td>Un <span class="nompato">Pato Ascendido</span> que genera <span class="nomcuack">400 Cuack/s</span></td>
					<td id="preOli"></td>
					<td id="canOli"></td>
					<td id="proOli"></td>
					<td><button class="botoncompra" onclick="comprar(6)">Comprar</button></td>
				</tr>
			</table>
		</div>

		<div id="Artefactos" class="tabcontent">  

				<table id="tablaartefactos" class="tablascompra">
					<tr id="trpart">
						<th>NOMBRE</th>
						<th>DESCRIPCIÓN</th>
						<th>PRECIO</th>
						<th></th>
					</tr>
					<tr id="ratonViejo">
						<td>RATÓN VIEJO</td>
						<td>Cuacks por click +1</td>
						<td>500</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(0)">Comprar</button></td>
					</tr>
					<tr id="gafasSol">
						<td>GAFAS DE SOL</td>
						<td>Cada <span class="nompato">Pato Turístico</span> grazna <span class="nomcuack">1 Cuack/s</span> adicional</td>
						<td>3000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(1)">Comprar</button></td>
					</tr>
					<tr id="cosechadora">
						<td>COSECHADORA</td>
						<td>Genera clicks cada segundo igual a tu <span class="nompato">Poder de click</span></td>
						<td>8000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(2)">Comprar</button></td>
					</tr>
					<tr id="flotador">
						<td>FLOTADOR CON FORMA DE PATO</td>
						<td>Construye una piscina comunitaria para tus patos. Conseguirás Poder de click al llenarla.</td>
						<td>12000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(3)">Comprar</button></td>
					</tr>
					<tr id="ratonInalambrico">
						<td>RATÓN INALÁMBRICO</td>
						<td>Cuacks por click +4</td>
						<td>15000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(4)">Comprar</button></td>
					</tr>
					<tr id="cetro">
						<td>CETRO DEL REY JUGADOR</td>
						<td>Tu pato se convierte en rey</td>
						<td>35000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(5)">Comprar</button></td>
					</tr>
					<tr id="estandarteGuerra">
						<td>ESTANDARTE DE GUERRA</td>
						<td>Envía a tus <span class="nompato">Patos Guerreros</span> a saquear</td>
						<td>40000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(6)">Comprar</button></td>
					</tr>
					<tr id="ratonExtranio">
						<td>RATÓN EXTRAÑO</td>
						<td>Aumenta tus clicks en un 25% de la Producción.</td>
						<td>80000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(7)">Comprar</button></td>
					</tr>
					<tr id="radar">
						<td>RADAR ESPACIAL</td>
						<td>Descúbre nuevas ubicaciones</td>
						<td>200000</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(8)">Comprar</button></td>
					</tr>
					<tr id="coronaOlimpo">
						<td>CORONA DEL OLÍMPO</td>
						<td>Producción x3, ya no podrás realizar expediciones</td>
						<td>Sello de la victoria</td>
						<td><button class="botoncompra" onclick="comprarArtefacto(9)">Comprar</button></td>
					</tr>
				</table>
		</div>

		<div id="Estadisticas" class="tabcontent"> 
			<div id="EstadisticasGrid">
				<div>
					<h3>GENERAL</h3>
					<p id="ScuackPC"></p>
					<p id="ScuackG"></p>
					<p id="SexpedicionesT"></p>
					<p id="SexpedicionesC"></p>
				</div>
				<div>
					<h3>ARTEFACTOS</h3>
					<p id="SartefactoC"></p>
					<p id="SclickCosechadora"></p>
					<p id="ScuackCosechadora"></p>
				</div>
				<div>
					<h3>CLICKS</h3>
					<p id="ScuackC"></p>
					<p id="Sclickpato"></p>
				</div>
				<div>
					<h3>TERRENOS</h3>
					<p id="ScuackP"></p>
					<p id="SterrenoI"></p>
					<p id="SterrenoC"></p>
				</div>	
			</div>
		</div>

		<div id="Logros" class="tabcontent"> 
			<table id="tablalogros" class="tablascompra">
					
					<tr>
						<td>Este charco es mío</td>
						<td>Hazte amigo de 10 patos Charcosos</td>
						<td>+800 Cuacks</td>
						<td><button id="rec0" class="botoncompra" onclick="reclamar(0)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Praia do Cuackssino</td>
						<td>Hazte amigo de 10 patos Lago</td>
						<td>+1200 Cuacks</td>
						<td><button id="rec1" class="botoncompra" onclick="reclamar(1)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Trotamundos</td>
						<td>Hazte amigo de 10 patos Turísticos</td>
						<td>+2400 Cuacks</td>
						<td><button id="rec2" class="botoncompra" onclick="reclamar(2)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Dia del trabajador</td>
						<td>Hazte amigo de 10 patos Campesinos</td>
						<td>+15000 Cuacks</td>
						<td><button id="rec3" class="botoncompra" onclick="reclamar(3)">Reclamar</button></td>
					</tr>
					<tr>
						<td>El rey de los patos</td>
						<td>Hazte amigo de 10 patos Guerreros</td>
						<td>+100 Poder de ejercito</td>
						<td><button id="rec4" class="botoncompra" onclick="reclamar(4)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Cuack Armstrong</td>
						<td>Hazte amigo de 10 patos Astronautas</td>
						<td>+10 Poder de Click</td>
						<td><button id="rec5" class="botoncompra" onclick="reclamar(5)">Reclamar</button></td>
					</tr>
					<tr>
						<td>KuaKuá</td>
						<td>Hazte amigo de 10 patos Ascendidos</td>
						<td>+100 Poder de Click</td>
						<td><button id="rec6" class="botoncompra" onclick="reclamar(6)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Multicultural</td>
						<td>Hazte amigo de 1 pato de cada tipo</td>
						<td>+22222 Cuacks</td>
						<td><button id="rec7" class="botoncompra" onclick="reclamar(7)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Pateador</td>
						<td>Haz click sobre el pato 1.000 veces</td>
						<td>+5001 Cuacks</td>
						<td><button id="rec8" class="botoncompra" onclick="reclamar(8)">Reclamar</button></td>
					</tr>
					<tr>
						<td>Patoa la vida</td>
						<td>Consigue un total de 1.000.000 Cuacks</td>
						<td>+50000 Cuacks</td>
						<td><button id="rec9" class="botoncompra" onclick="reclamar(9)">Reclamar</button></td>
					</tr>
					<tr>
						<td>LudóPata</td>
						<td>Compra todos los artefactos</td>
						<td>+77777 Cuacks</td>
						<td><button id="rec10" class="botoncompra" onclick="reclamar(10)">Reclamar</button></td>
					</tr>

				</table>
		</div>

		<div id="Expediciones" class="tabcontent"> 
			<div  id="bosque">
			  	<div>
			  		<h2>BOSQUE</h2>
				  	<p>Poder: 3</p>
				  	<p>Coste: 7000 C</p>
			    </div>
			  	
			  	<div class="barraExpedicion">
					<div id="bosqueBar" class="barraProgreso"></div>
					<div class="recompensa" id="rBosque" hidden="true">
						<h3 id="bosqueVD"></h3>	
						<div>
							<p id="bosqueR"></p>
							<button class="botoncompra" onclick="reclamaRecompensa(0)">REGRESAR</button>
						</div>
					</div>
				</div>					  	
			  
				<div>
			  		<button class="botonAcceder" id="botonBosque" onclick="entrarExpedicion(0)"><span>ACCEDER</span></button>		  	
			  	</div>
			</div>

			<div  id="pantano">
			  	<div>
			  		<h2>PANTANO</h2>
				  	<p>Poder: 20</p>
				  	<p>Coste: 18000 C</p>
				  	
			    </div>
			  	<div  class="barraExpedicion">
					<div id="pantanoBar" class="barraProgreso"></div>
					<div class="recompensa" id="rPantano" hidden="true">
						<h3 id="pantanoVD"></h3>	
						<div>
							<p id="pantanoR"></p>
							<button class="botoncompra" onclick="reclamaRecompensa(1)">REGRESAR</button>
						</div>
					</div>
				</div>					  	
			  
				<div>
			  		<button class="botonAcceder" id="botonPantano" onclick="entrarExpedicion(1)"><span>ACCEDER</span></button>		  	
			  	</div>
			</div>

			<div  id="cascada">

			  	<div>
			  		<h2>CASCADA</h2>
				  	<p>Poder: 100</p>
				  	<p>Coste: 30000 C</p>  	
			    </div>

			  	<div  class="barraExpedicion">
					<div id="cascadaBar" class="barraProgreso"></div>
					<div class="recompensa" id="rCascada" hidden="true">
						<h3 id="cascadaVD"></h3>	
						<div>
							<p id="cascadaR"></p>
							<button class="botoncompra" onclick="reclamaRecompensa(2)">REGRESAR</button>
						</div>
					</div>
				</div>	

				<div>
			  		<button class="botonAcceder" id="botonCascada" onclick="entrarExpedicion(2)"><span>ACCEDER</span></button>		  	
			  	</div>

			</div>

			<div id="cueva">

			  	<div>
			  		<h2>CUEVA</h2>
				  	<p>Poder: 600</p>
				  	<p>Coste: 43000 C</p>
			    </div>

			  	<div class="barraExpedicion">
					<div id="cuevaBar" class="barraProgreso"></div>
					<div class="recompensa" id="rCueva" hidden="true">
						<h3 id="cuevaVD"></h3>	
						<div>
							<p id="cuevaR"></p>
							<button class="botoncompra" onclick="reclamaRecompensa(3)">REGRESAR</button>
						</div>
					</div>
				</div>	

				<div>
			  		<button class="botonAcceder" id="botonCueva" onclick="entrarExpedicion(3)"><span>ACCEDER</span></button>		  	
			  	</div>
			</div>

			<div id="montania">

			  	<div>
			  		<h2>MONTAÑA</h2>
				  	<p>Poder: 3000</p>
				  	<p>Coste: 60000 C</p>
			    </div>

			  	<div class="barraExpedicion">
					<div id="montaniaBar" class="barraProgreso"></div>
					<div class="recompensa" id="rMontania" hidden="true">
						<h3 id="montaniaVD"></h3>	
						<div>
							<p id="montaniaR"></p>
							<button class="botoncompra" onclick="reclamaRecompensa(4)">REGRESAR</button>
						</div>
					</div>
				</div>	

				<div>
			  		<button class="botonAcceder" id="botonMontania" onclick="entrarExpedicion(4)"><span>ACCEDER</span></button>		  	
			  	</div>

			</div>

			<div id="volcan">
			  	<div>
			  		<h2>VOLCÁN</h2>
				  	<p>Poder: 10000</p>
				  	<p>Coste: 1000000 C</p>
				  	
			    </div>
			  	<div>
			  		<h3>RECOMPENSAS</h3> 			
			  		<p>Sello de la victoria</p>		  	
			  	</div>
				<div>
			  		<button class="botonAcceder" onclick=""><span>ACCEDER</span></button>		  	
			  	</div>
			</div>

		</div>
	</div>	

	<footer>
		<p>«Copyright © 2022 | Adrian Lacueva y Manuel Sánchez» <br> +34 695 357 951 | clicking@duck.com<br>
		<span id="eslogan">Una experiencia (pa’ to)da la vida.</span></p>
		<img class="imgfoot" src="imagenes/favicon.png">
	</footer>

</body>
</html>