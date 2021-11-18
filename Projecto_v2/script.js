var cuack = 0;
var cuackseg = 0;
var poderclic = 1;
var poderejercito = 0;

//ejercito
var guerra = false;
var armamento = 0;
var espada = false;
var casco = false;
var martillo = false;
var hacha = false;
var sello = false;

//estadisticas
//37 - 15x + 6x^2 subida de precio
//124 - 59x + 9x^2
var Sclicenpato = 0;
var SterrenoC = 0;
var SterrenoI = 0; //cuakcs gastados en terrenos
var SartefactoC = 0;
var ScuackP = 0;
var ScuackC = 0;
var ScuackG = 0; // cuacks gastados totales
var SexpedicionesT = 0;
var SexpedicionesC = 0;

var ScuackCosechadora = 0;
var SclickCosechadora = 0;

var terreno = [0,0,0,0,0,0,0,0];
var cuackproduct = [1,2,4,0,-5,30,100,1];
var precioterreno = [10,200,1200,15000,50000,70000,100000,0];
var pround = [0,0,0,0,0,0,0,0];

var artefacto = [false,false,false,false,false,false,false];
var precioartefacto = [500, 3000, 6500, 12000, 15000, 35000, 40000, 80000, 200000, 99999999999];

var ext = false;
var cosechadora = false;

function clic(){
	cuack += poderclic;
	ScuackC += poderclic;
	if(ext){
		cuack += Math.round(parseInt(cuackseg/95));
		ScuackC += Math.round(parseInt(cuackseg/95));
	}
	Sclicenpato++;

}

function comprar(numero){
	if(cuack >= precioterreno[numero]){
		terreno[numero]++;
		cuack -= precioterreno[numero];
		x = parseInt(terreno[numero]);
		ScuackG += precioterreno[numero]; //estadistica c gastado
		SterrenoI += precioterreno[numero]; //inversion terreno
		if(numero!=7)
			precioterreno[numero] = Math.round(parseInt(37 - (15 * x) + 6 * (Math.pow(x, 2))) + precioterreno[numero]);
		else
			precioterreno[numero]+=200;
		pround[numero] = terreno[numero] * cuackproduct[numero];
		actualizarproduccion();
		SterrenoC++;
	}
	if(terreno[4] == 10){
		$("#botoncompracastillo").remove();
	}
	if(terreno[7] == 5){
		poderclic++;
		$("#botoncomprapiscina").remove();
	}
}

function comprarArtefacto(numero){
	if(cuack >= precioartefacto[numero]){
		switch (numero) {
  		case 0:
    		poderclic++;
    		$("#ratonViejo").remove();
    	break;
    	case 1:
    		cuackproduct[2]++;
    		$("#cuackPlaya").after(" (+1)")
    		$("#gafasSol").remove();			
    	break;
    	case 2:
    		cosechadora=true;
    		$("#cosechadora").remove();	
    	break;
    	case 3:	
    		$("#piscina").show();
    		$("#flotador").remove();
    	break;
    	case 4:
    		poderclic+=4;
    		$("#ratonInalambrico").remove();
    	break;
  		case 5:
    		$("#castillo").show();
    		$("#cetro").remove();
    		$("#poderejercito").show();
    		guerra = true;
    	break;
    	case 6:
    		$("#tabExpediciones").show();
			$("#estandarteGuerra").remove();	
			$("#volcan").hide();
    		$("#montania").hide();
    	break;
    	case 7:
    		ext=true;
				$("#ratonExtranio").remove();	
    	break;
    	case 8:	
    		$("#volcan").show();
    		$("#montania").show();
				$("#radar").remove();	
    	break;
    	case 9:
    		
    	break;
		}
		artefacto[numero] = true;
		cuack -= precioartefacto[numero];
		ScuackG += precioartefacto[numero]; //estadistica c gastado
		SartefactoC++; //estadística num artefactos
		actualizarproduccion();
	}
}

function actualizarproduccion(){
	cuackseg=0;
	for (i=0; i<terreno.length; i++){
		if(i==3){
			cuackseg += Math.round(parseInt(terreno[i] * terreno[1]));
		}
		if(i==4){
			cuackseg += Math.round(parseInt((terreno[i] * cuackproduct[i] * (cuackseg/100))));
	
		}
		else{
			cuackseg += Math.round(parseInt(terreno[i] * cuackproduct[i]));
	
		}
	}
	
}

function produccion(){
	cuack += Math.round(parseInt(cuackseg));
	ScuackP += Math.round(parseInt(cuackseg));
	
	if(cosechadora){
		SclickCosechadora++;
		cuack += poderclic;
		ScuackCosechadora += poderclic;
			if(ext){
			cuack += Math.round(parseInt(cuackseg/95));
			ScuackCosechadora += Math.round(parseInt(cuackseg/95));
			}
		}
}

//guerreros

function poder(){
	poderejercito = armamento;
	for(i=0;i<terreno[4];i++){
		poderejercito += 3;
		if (espada){
			poderejercito += 5;
		}
		if (martillo){
			poderejercito += 25;
		}
		if (hacha){
			poderejercito += 100;
		}
	}
}

function render(){
	//cuakcs
	document.getElementById("cuacks").innerHTML = "Monedero: <span>" + cuack + " Cuacks</span>";
	document.getElementById("cuackseg").innerHTML = "Producción: <span>" + cuackseg + " Cuacks/s </span>";
	document.getElementById("poderclic").innerHTML = "Poder de click: <span>" + poderclic + "</span>"; 
	if(ext){
		document.getElementById("poderclic").innerHTML = "Poder de click: <span>" + (poderclic + Math.round(parseInt(cuackseg/95)))+ "</span>"; 
	}
	//estadísticas
	document.getElementById("Sclickpato").innerHTML = "Clicks manuales: " + Sclicenpato;
	document.getElementById("SterrenoC").innerHTML = "Terrenos comprados: " + SterrenoC;
	document.getElementById("SartefactoC").innerHTML = "Artefactos comprados: " + SartefactoC + "/10";
	document.getElementById("ScuackP").innerHTML = "Cuacks generados: " + ScuackP;
	document.getElementById("ScuackC").innerHTML = "Cuacks generados: " + ScuackC;
	document.getElementById("ScuackPC").innerHTML = "Cuacks generados: " + (ScuackP + ScuackC + ScuackCosechadora);
	document.getElementById("ScuackG").innerHTML = "Cuacks gastados: " + ScuackG;
	document.getElementById("SterrenoI").innerHTML = "Cuacks invertidos: " + SterrenoI;
	document.getElementById("SexpedicionesT").innerHTML = "Expediciones realizadas: " + SexpedicionesT;
	document.getElementById("SexpedicionesC").innerHTML = "Expediciones completadas: " + SexpedicionesC;

	document.getElementById("SclickCosechadora").innerHTML = "Clicks cosechados: " + SclickCosechadora;
	document.getElementById("ScuackCosechadora").innerHTML = "Cuacks cosechados : " + ScuackCosechadora;

	//terrenos
	document.getElementById("canCha").innerHTML = terreno[0];
	document.getElementById("canLag").innerHTML = terreno[1];
	document.getElementById("canPla").innerHTML = terreno[2];
	document.getElementById("canPis").innerHTML = terreno[7] + "/5";
	document.getElementById("canGra").innerHTML = terreno[3];
	document.getElementById("canGue").innerHTML = terreno[4] + "/10";
	document.getElementById("canAst").innerHTML = terreno[5];
	document.getElementById("canOli").innerHTML = terreno[6];
	
	//precios
	document.getElementById("preCha").innerHTML = precioterreno[0];
	document.getElementById("preLag").innerHTML = precioterreno[1];
	document.getElementById("prePla").innerHTML = precioterreno[2];
	document.getElementById("preGra").innerHTML = precioterreno[3];
	document.getElementById("preGue").innerHTML = precioterreno[4];
	document.getElementById("preAst").innerHTML = precioterreno[5];
	document.getElementById("preOli").innerHTML = precioterreno[6];
	document.getElementById("prePis").innerHTML = precioterreno[7];

	//produccion
	document.getElementById("proCha").innerHTML = pround[0]+ " C/s";
	document.getElementById("proLag").innerHTML = pround[1]+ " C/s";
	document.getElementById("proPla").innerHTML = pround[2]+ " C/s";
	document.getElementById("proGra").innerHTML = terreno[3] * terreno[1] + " C/s";
	costeGuerreros = parseInt((terreno[4] * cuackproduct[4] * (cuackseg/100))); //guerreros
	Math.round(costeGuerreros);	//guerreros
	document.getElementById("proGue").innerHTML = costeGuerreros + " C/s"; //guerreros
	document.getElementById("proAst").innerHTML = pround[5]+ " C/s";
	document.getElementById("proOli").innerHTML = pround[6]+ " C/s";
	document.getElementById("proPis").innerHTML = pround[7]+ " C/s";

	//ejercito
	document.getElementById("poderejercito").innerHTML = "Poder de ejercito: <span>" + poderejercito + "</span>";

}

var FPSP = 1;
var FPS = 30;

setInterval(function(){
	render();

},1000/FPS);

setInterval(function(){
	produccion();
	if(guerra){
		poder();
	}
	

},1000/FPSP);

//EXPDS



function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

function entrarExpedicion(num) {
	var width = 0;
	switch (num) {

  		case 0:
	  		if(cuack >= 10000){
	  			cuack -= 10000;
	    		var elem = document.getElementById("bosqueBar");   
				  var id = setInterval(frame, 150);
				  var recompensa = 0;
				  document.getElementById("botonBosque").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=3){
				      	document.getElementById("bosqueVD").innerHTML = "VICTORIA!";
								recompensa = getRandomInt(0,2);
								if(recompensa==1){
									document.getElementById("bosqueR").innerHTML = "Experiencia militar (+1 Poder)";
									armamento++;
								}
								if(recompensa==0){
									document.getElementById("bosqueR").innerHTML = "Experiencia militar (+2 Poder)";
									armamento += 2;
								}
				      }
				      else{
				      	document.getElementById("bosqueVD").innerHTML = "DERROTA...";
				      }
				      $("#rBosque").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				  } 
			  }
    	break;


    	case 1:
			if(cuack >= 30000){
	  			cuack -= 30000;
	    		var elem = document.getElementById("pantanoBar");   
				  var id = setInterval(frame, 400);
				  var recompensa = 0;
				  document.getElementById("botonPantano").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=20){
				      	document.getElementById("pantanoVD").innerHTML = "VICTORIA!";
								recompensa = getRandomInt(0,3);
								if(recompensa==1){
									if(!espada){
										document.getElementById("pantanoR").innerHTML = "¡Encontraste una espada! (+5 Poder por cada Guerrero)";
										espada = true;
									}
									else{
										document.getElementById("pantanoR").innerHTML = "Experiencia militar (+3 Poder)";
										armamento += 3;
										
									}
								}
								else{
									document.getElementById("pantanoR").innerHTML = "Experiencia militar (+2 Poder)";
									armamento += 2;
								}
				      }
				      else{
				      	document.getElementById("pantanoVD").innerHTML = "DERROTA...";
				      }
				      $("#rPantano").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				  } 
			}
    	
    	break;
    	case 2:
    		if(cuack >= 70000){
	  			cuack -= 70000;
	    		var elem = document.getElementById("cascadaBar");   
				  var id = setInterval(frame, 700);
				  var recompensa = 0;
				  document.getElementById("botonCascada").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=100){
				      	document.getElementById("cascadaVD").innerHTML = "VICTORIA!";
								recompensa = getRandomInt(0,9);
								if(recompensa==1){
									if(!espada){
										document.getElementById("cascadaR").innerHTML = "¡Encontraste una espada! (+5 Poder por cada Guerrero)";
										espada = true;
									}
									else{
										document.getElementById("cascadaR").innerHTML = "Experiencia militar (+8 Poder)";
										armamento += 8;
										
									}
								}
								if(recompensa==2){
									if(!casco){
										document.getElementById("cascadaR").innerHTML = "¡Encontraste un casco! (+100 Poder)";
										casco = true;
										armamento += 100;
									}
									else{
										document.getElementById("cascadaR").innerHTML = "Experiencia militar (+8 Poder)";
										armamento += 8;
										
									}
								}
								if(recompensa==3){
									document.getElementById("cascadaR").innerHTML = "Experiencia militar (+20 Poder)";
									armamento += 20;
								}
								else{
									document.getElementById("cascadaR").innerHTML = "Experiencia militar (+5 Poder)";
									armamento += 2;
								}
				      		}
				      else{
				      	document.getElementById("cascadaVD").innerHTML = "DERROTA...";
				      }
				      $("#rCascada").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				} 
			}
    	
    	break;
    	case 3:
    	if(cuack >= 100000){
	  			cuack -= 100000;
	    		var elem = document.getElementById("cuevaBar");   
				var id = setInterval(frame, 1200);
				var recompensa = 0;
				document.getElementById("botonCueva").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=600){
				      			document.getElementById("cuevaVD").innerHTML = "VICTORIA!";
								recompensa = getRandomInt(0,3);
								if(recompensa==1){
									if(!martillo){
										document.getElementById("cuevaR").innerHTML = "¡Encontraste una martillo! (+100 Poder por cada Guerrero)";
										martillo = true;
									}
									else{
										document.getElementById("cuevaR").innerHTML = "Experiencia militar (+30 Poder)";
										armamento += 30;
										
									}
								}
								
								else{
									document.getElementById("cuevaR").innerHTML = "Experiencia militar (+15 Poder)";
									armamento += 15;
								}
				      		}
				      else{
				      	document.getElementById("cuevaVD").innerHTML = "DERROTA...";
				      }
				      $("#rCueva").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				} 
			}
			
    	break;
    	case 4:
    		if(cuack >= 150000){
	  			cuack -= 150000;
	    		var elem = document.getElementById("montaniaBar");   
				  var id = setInterval(frame, 2000);
				  var recompensa = 0;
				  document.getElementById("botonMontania").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=3000){
				      	document.getElementById("montaniaVD").innerHTML = "VICTORIA!";
								recompensa = getRandomInt(0,2);
								if(recompensa==1){
									document.getElementById("montaniaR").innerHTML = "Experiencia militar (+100 Poder)";
									armamento+= 100;
								}
								if(recompensa==0){
									if(!hacha){
										document.getElementById("cuevaR").innerHTML = "¡Encontraste una hacha! (+100 Poder por cada Guerrero)";
										hacha = true;
									}
									else{
										document.getElementById("cuevaR").innerHTML = "Experiencia militar (+300 Poder)";
										armamento += 300;
										
									}
								}
				      }
				      else{
				      	document.getElementById("montaniaVD").innerHTML = "DERROTA...";
				      }
				      $("#rMontania").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				  } 
			  }
    	break;
  		case 5:
    		if(cuack >= 500000){
	  			cuack -= 500000;
	    		var elem = document.getElementById("volcanBar");   
				  var id = setInterval(frame, 5000);
				  var recompensa = 0;
				  document.getElementById("botonVolcan").disabled = true;
				  function frame() {
				    if (width >= 100) {
				      clearInterval(id);
				      if(poderejercito>=10000){
				      	document.getElementById("volcanVD").innerHTML = "VICTORIA!";
						document.getElementById("volcanR").innerHTML = "Conseguiste el Sello de la victoria!";
						sello = true;
				      }
				      else{
				      	document.getElementById("volcanVD").innerHTML = "DERROTA...";
				      }
				      $("#rVolcan").show();
				    } else {
				      width++; 
				      elem.style.width = width + '%'; 
				    }		   
				  } 
			  }
    	break;
  }
}



function reclamaRecompensa(num){
	switch (num) {
  		case 0:
    		$("#rBosque").hide();
    		document.getElementById("botonBosque").disabled = false;
    	break;
    	case 1:
    		$("#rPantano").hide();
    		document.getElementById("botonPantano").disabled = false;
    	break;
    	case 2:
    		$("#rCascada").hide();
    		document.getElementById("botonPantano").disabled = false;
    	break;
    	case 3:
			$("#rCueva").hide();
    		document.getElementById("botonPantano").disabled = false;
    	break;
    	case 4:
    		$("#rMontania").hide();
    		document.getElementById("botonPantano").disabled = false;
    	break;
  		case 5:
    		$("#rVolcan").hide();
    		document.getElementById("botonPantano").disabled = false;
    	break;
	}
}
//LOGROS

//tienda - 
function abrirMenu(evt, tab) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tab).style.display = "block";
  evt.currentTarget.className += " active";
}


