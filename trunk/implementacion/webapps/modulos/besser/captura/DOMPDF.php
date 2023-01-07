	<div class="container-fluid">
		<table style="width:100%">
			<tr>
				<td style="width: 25%;">
					<img src="https://invoice-mx.com/img/logo.png" style="width: 100%;">
				</td>
				<td style="padding: 20px;">
					<h4>
						REPORTE DIARIO DE PRODUCCIÓN Y MOVIMIENTO DE MATERIALES EN BLOQUERA BESSER
					</h4>
				</td>
			</tr>
		</table>
		<table style="width: 80%; margin-left: 10%;">
			<tr>
				<td>
					Fecha_registro
					<br>
					<span><b>FOLIO:</b> cve_produccion_bloquera</span>
					<br>
					<br>
					<span><b>HOROMETRO INICIAL:</b> horómetro_inicial</span>
					<br>
					<span><b>HOROMETROFINAL:</b> horómetro_final</span>
					<br>
					<span><b>DIFERENCIA:</b> horómetro_diferencia</span>
				</td>
				<td>
					<table class="table table-bordered" style="border-collapse: collapse;">
						<tr style="border: solid 1px;">
							<th>PRODUCTO</th>
						</tr>
						<tr style="border: solid 1px;">
							<td>
								nombre_producto – presentación – num_celdas ->cve_bloquera
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="row" style=" margin-top: 10px;">
			<table class="table table-bordered" style="width: 60%; margin-left:20%; border-collapse: collapse;">
				<tr>
					<th style="border: solid 1px; text-align: left;">TIPO DE POLVO</th>
					<td style="border: solid 1px; text-align: left;">turno</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">N° DE BANDEJAS BRUTAS</th>
					<td style="border: solid 1px; text-align: left;">Bandejas_producidas</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">N° DE PIEZAS</th>
					<td style="border: solid 1px; text-align: left;">Piezas_totales + cant_pesadas</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">CONSUMO DE CEMENTO</th>
					<td style="border: solid 1px; text-align: left;">Consumototal_cemento</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">Grs. CEMENTO POR PIEZA </th>
					<td style="border: solid 1px; text-align: left;">Cementopor_pieza</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">TIEMPO DE LLENADO</th>
					<td style="border: solid 1px; text-align: left;">Tiempo_llenado</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">CONSUMO DE ADITIVO</th>
					<td style="border: solid 1px; text-align: left;">Consumo_aditivo</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">HUMEDAD</th>
					<td style="border: solid 1px; text-align: left;">humedad</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">PESO PROMEDIO</th>
					<td style="border: solid 1px; text-align: left;">Peso_promedio</td>
				</tr>
				<tr>
					<th style="border: solid 1px; text-align: left;">PESADAS</th>
					<td style="border: solid 1px; text-align: left;">Cant_pesadas</td>
				</tr>
			</table>
			<table style="margin-top: 10px; border-collapse: collapse; border: solid 1px;">
				<tr>
					<th style="text-align: center; border: solid 1px;" colspan="9">CAMBIOS DE DOSIFICACIÓN</th>
				</tr>
				<tr>
					<td style=" border: solid 1px; text-align: center;" colspan="2">LATAS</td>
					<td style=" border: solid 1px; text-align: center;" colspan="2">GRAVILLA</td>
					<td style=" border: solid 1px; text-align: center;" colspan="2">% AGREGS.</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">KG De Cemento P/ barcada</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">N° De Barcadas</td>
					<td style=" border: solid 1px; text-align: center;" rowspan="2">TOTAL CEMENTO</td>
				</tr>
				<tr>
					<td style=" border: solid 1px; text-align: center;">LATA</td>
					<td style=" border: solid 1px; text-align: center;">SEGS.</td>
					<td style=" border: solid 1px; text-align: center;">LATA</td>
					<td style=" border: solid 1px; text-align: center;">SEGS.</td>
					<td style=" border: solid 1px; text-align: center;">POLVO</td>
					<td style=" border: solid 1px; text-align: center;">GRAVILLA</td>
				</tr>
				<tr>
					<td style=" border: solid 1px; font-size:12px;">Cantidad_polvo</td>
					<td style=" border: solid 1px; font-size:12px;">Segundos_polvo</td>
					<td style=" border: solid 1px; font-size:12px;">Cantidad_gravilla</td>
					<td style=" border: solid 1px; font-size:12px;">Segundo_gravialla</td>
					<td style=" border: solid 1px; font-size:12px;">Porcer_polvo</td>
					<td style=" border: solid 1px; font-size:12px;">Porcert_gravilla</td>
					<td style=" border: solid 1px; font-size:12px;" rowspan="2">Cementopor_barcada</td>
					<td style=" border: solid 1px; font-size:12px;" rowspan="2">Cantidad_barcadas</td>
					<td style=" border: solid 1px; font-size:12px;" rowspan="2">Consumototal_cemento</td>
				</tr>
				<tr>
					<td style="font-size:12px;" colspan="2"></td>
					<td style="font-size:12px;">Consumototal_cemento</td>
					<td style="font-size:12px;">Segundos_gravillados</td>
					<td style="font-size:12px;"></td>
					<td style="font-size:12px;">Porcer_gravillados</td>
				</tr>
			</table>
		</div>
		<div class="row" style="margin-top: 100px; width: 30%; margin-left:35%;">
			<div class="col-4 offset-4 mt-4 pt-4">
				<center>
					<hr>
					usuario->cat_usuarios
					<br>
					puesto->cat_usuario
				</center>
			</div>
		</div>
	</div>