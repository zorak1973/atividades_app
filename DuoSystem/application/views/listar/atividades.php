		<?php $this->load->view('listar/topo'); 
		$options = array(0 => "Selecione Filtro", 1 => "Status", 2 => utf8_encode("Situacão"));
		?>
		<form class="navbar-form navbar-right" method="post">
            <div class="form-group">
              <?php echo form_dropdown('status-filtro', $options, '', 'id="filtro" class="form-control"'); ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Filtrar</button>
          </form>
			
			<?php if($total): ?>
			<table  class="table table-bordered table-striped" >
				<thead>
					<tr>
						<th width="10">ID</th>
						<th><?php echo utf8_encode('Nome'); ?></th>
						<th><?php echo utf8_encode('Descrição'); ?></th>
						
						<th><?php echo utf8_encode('Data Inicio'); ?></th>
						<th><?php echo utf8_encode('Data Final'); ?></th>
						<th><?php echo utf8_encode('Status'); ?></th>	
						
						<th><?php echo utf8_encode('Situação'); ?></th>						
						<th width="10"><?php echo img(array('src' => 'media/img/edit.png', 'title' => 'editar')); ?></th>
						
					</tr>
				</thead>
				<tbody>
					<?php foreach($query as $line => $row):?>
					<tr	class="<?php if($row->status == 4):echo "info";endif; ?>">
						<td><?php echo $row->id_atv; ?></td>
						<td><?php echo $row->nome; ?></td>
						<td><?php echo $row->descricao; ?></td>
						<td><?php echo $row->data_inicio; ?></td>
						
						
						<td><?php 
							if(!empty($row->data_fim)):
								echo $row->data_fim;
							endif;	
						?>
						</td>
						<?php
						/*$stat = "";
						switch($row->status){
							case 1:
								$stat = "Pendente";
							break;
							case 2:
								$stat = "Em Desenvolvimento";
							break;
							case 3:
								$stat = "Em Teste";
							break;
							case 4:
								$stat = "Concluido";
							break;
							default:
								$stat = "Ignorado";
							break;
						}*/
						?>
						<td><?php echo $row->desc_status; ?></td>
						
						<td><?php if($row->situacao == 1){ echo "ativo"; }else{ echo "inativo"; } ?></td>
						<td width="10"><?php echo anchor('editar/' . $this->uri->segment(2) . '/' . $row->id_atv, img(array('src' => 'media/img/edit.png', 'title' => 'editar')))?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php else: ?>
			<div class="esp2">
				<div class="grid_20 prefix_1"><div class="title">nenhum registro encontrado.</div></div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
			<br />
			<?php $this->load->view('listar/paginacao'); ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php echo form_button('novo', 'Novo', 'class="btn btn-primary redirect" redirect="' . base_url() . 'cadastrar/' . $this->uri->segment(2) . '"');?>
					</div>
				</div>
			</div>
		
		
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">&nbsp;</div>
			<div class="col-md-4">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-8">&nbsp;</div>
			<div class="col-md-4">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-8">&nbsp;</div>
			<div class="col-md-4">&nbsp;</div>
		</div>
		</div>
	
