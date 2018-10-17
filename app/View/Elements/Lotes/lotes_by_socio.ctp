
<table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" id="tabla-lotes">
	<thead>
		<tr>
			<th># Lote</th>
			<th>Año de Pago</th>
			<th>Mes Inicio</th>
			<th>Mes Hasta</th>
			<th>Monto</th>
			<th>Observaciones</th>
			<th>Confirmar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($lotes as $key => $lote) { ?>
		<tr>
			<td><?php echo $lote['Lote']['numero']; 
				echo $this->Form->input('Cuota.detalle.'.$key.'.lote_id', array('class' => 'form-control', 'type' => 'hidden', 'value' => $lote['Lote']['id']));
			?></td>
			<td><?php
			echo $this->Form->input('Cuota.detalle.'.$key.'.anio_pago', array('class' => 'form-control', 'type' => 'text', 'value' => date('Y'), 'required' => true, 'label' => false, 'title' => 'Año al que corresponde el pago', 'style' => '    min-width: 60px;'));
			?></td>
			<td><?php
			echo $this->Form->input('Cuota.detalle.'.$key.'.mes_desde', array('class' => 'form-control', 'value' => date('m'), 'required' => true, 'label' => false, 'title' => 'Mes de inicio al que corresponde el pago', 'options' => $mes_desde, 'onchange' => "calcularMonto($key);", 'style' => '    min-width: 100px;'));
			?></td>
			<td><?php
			echo $this->Form->input('Cuota.detalle.'.$key.'.mes_hasta', array('class' => 'form-control', 'value' => date('m'), 'required' => true, 'label' => false, 'title' => 'Mes de fin al que corresponde el pago', 'options' => $mes_hasta, 'onchange' => "calcularMonto($key);", 'style' => '    min-width: 100px;'));
			?></td>
			<td><?php
			echo $this->Form->input('Cuota.detalle.'.$key.'.monto', array('class' => 'form-control', 'label' => false, 'div' => false, 'style' => '    min-width: 100px;'));
			?></td>
			<td><?php
			echo $this->Form->input('Cuota.detalle.'.$key.'.observacion', array('class' => 'form-control', 'label' => false, 'div' => false, 'type' => 'text', 'style' => '    min-width: 60px;', 'title' => 'Debe completar la observación, si el MONTO ingresado ha sido modificado. Puede además, ingresar una observación para detalalr el cobro de la cuota.'));
			?></td>
			<td><?php echo $this->Form->checkbox('Cuota.detalle.'.$key.'.confirmar', array('onclick' => 'validarCuota($(this),'.$key.','."'".$lote['Lote']['id']."'".',$("#CuotaDetalle'.$key.'AnioPago").val(),$("#CuotaDetalle'.$key.'MesDesde").val(),$("#CuotaDetalle'.$key.'MesHasta").val())','label' => false, 'style' => 'width: 20px; height: 20px; min-width: 60px;', 'title' => 'Debe checkear este campo, para confirmar el pago de la cuota. Caso contrario, el sistema no generará el recibo por la cuota del lote que NO esta checkeado.')) ?></td>
		</tr> 

		<?php } ?>		
	</tbody>
</table>

<script type="text/javascript">
	$(function(){
		$("#tabla-lotes tbody tr").each(function (index) {
			calcularMonto(index);
		});
	});
	
	function calcularMonto(index) {
		var montoCuota = "<?php echo $monto['Parametro']['valor'] ?>";
		var montoCalculado;
		var mes_inicio;
		var mes_fin;
		var meses;
		mes_inicio = $('#CuotaDetalle'+index+'MesDesde').val();
		mes_fin = $('#CuotaDetalle'+index+'MesHasta').val();
		meses = (mes_fin - mes_inicio) + 1;			
		montoCalculado = meses * montoCuota;
		$('#CuotaDetalle'+index+'Monto').val(montoCalculado);
		
	}
</script>
