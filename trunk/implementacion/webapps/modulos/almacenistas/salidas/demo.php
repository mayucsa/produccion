<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        canvas {
            width: 500px;
            height: 300px;
            background-color: white;
            border: solid 1px;
        }
    </style>
    <title>Solicitar firma de usuario</title>
</head>

<body>
    <p>Firmar a continuación:</p>
    <canvas id="pizarra"></canvas>
    <br>
    <button id="btnLimpiar" onclick="limpiar()">Limpiar</button>
    <button id="btnDescargar">Descargar</button>
    <button id="btnGenerarDocumento">Pasar a documento</button>
    <br>
    
    <script>
        function limpiar(){
            document.querySelector('#pizarra').innerHTML = '';
        }
        //======================================================================
        // VARIABLES
        //======================================================================
        let miCanvas = document.querySelector('#pizarra');
        let lineas = [];
        let correccionX = 0;
        let correccionY = 0;
        let pintarLinea = false;
        // Marca el nuevo punto
        let nuevaPosicionX = 0;
        let nuevaPosicionY = 0;

        let posicion = miCanvas.getBoundingClientRect()
        correccionX = posicion.x;
        correccionY = posicion.y;

        miCanvas.width = 500;
        miCanvas.height = 300;

        //======================================================================
        // FUNCIONES
        //======================================================================

        /**
         * Funcion que empieza a dibujar la linea
         */
        function empezarDibujo() {
            pintarLinea = true;
            lineas.push([]);
        };

        /**
         * Funcion que guarda la posicion de la nueva línea
         */
        function guardarLinea() {
            lineas[lineas.length - 1].push({
                x: nuevaPosicionX,
                y: nuevaPosicionY
            });
        }

        /**
         * Funcion dibuja la linea
         */
        function dibujarLinea(event) {
            event.preventDefault();
            if (pintarLinea) {
                let ctx = miCanvas.getContext('2d')
                // Estilos de linea
                ctx.lineJoin = ctx.lineCap = 'round';
                ctx.lineWidth = 5;
                // Color de la linea
                ctx.strokeStyle = 'black';
                // Marca el nuevo punto
                if (event.changedTouches == undefined) {
                    // Versión ratón
                    nuevaPosicionX = event.layerX;
                    nuevaPosicionY = event.layerY;
                } else {
                    // Versión touch, pantalla tactil
                    nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
                    nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
                }
                // Guarda la linea
                guardarLinea();
                // Redibuja todas las lineas guardadas
                ctx.beginPath();
                lineas.forEach(function (segmento) {
                    ctx.moveTo(segmento[0].x, segmento[0].y);
                    segmento.forEach(function (punto, index) {
                        ctx.lineTo(punto.x, punto.y);
                    });
                });
                ctx.stroke();
            }
        }

        /**
         * Funcion que deja de dibujar la linea
         */
        function pararDibujar () {
            pintarLinea = false;
            guardarLinea();
        }

        //======================================================================
        // EVENTOS
        //======================================================================

        // Eventos raton
        miCanvas.addEventListener('mousedown', empezarDibujo, false);
        miCanvas.addEventListener('mousemove', dibujarLinea, false);
        miCanvas.addEventListener('mouseup', pararDibujar, false);

        // Eventos pantallas táctiles
        miCanvas.addEventListener('touchstart', empezarDibujo, false);
        miCanvas.addEventListener('touchmove', dibujarLinea, false);
    </script>
</body>

</html>