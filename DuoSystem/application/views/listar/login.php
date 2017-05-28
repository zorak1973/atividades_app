   <div class="grid_24" id="listar">
	<div id="form">
	
		<div class="esp">
			<div class="grid_22 prefix_1"><div class="title"><?php echo $title; ?></div></div>
			<div class="clear"></div>
		</div>
		
		<?php echo form_open('listar/' . $this->uri->segment(2), 'method="get"'); ?>
		<div class="esp prefix_1">
			<div class="grid_3 bt"><?php echo form_button('novo', 'Novo', 'class="redirect" redirect="' . base_url() . 'cadastrar/login"');?></div>
			<div class="grid_4 prefix_12"><?php echo form_input('busca', (isset($_GET['busca']) && $_GET['busca']) ? $_GET['busca'] : '');?></div>
			<div class="grid_3 bt"><?php echo form_submit('buscar', 'Buscar');?></div>
			<div class="clear"></div>
		</div>
		<?php echo form_close(); ?>
		<hr />
		<?php //echo form_open('listar/' . $this->uri->segment(2), 'method="POST"'); ?>
		<!--<div class="esp prefix_1">
			<?php //$tamanho = array(10 =>'10 registros', 20 =>'20 registros', 30 =>'30 registros', 50 =>'50 registros'); ?>
			<div class="grid_2"><label for="tamlista">Exibir</label></div>
			<div class="grid_3"><?php //echo form_dropdown('por_pag', $tamanho, 'id="tamlista"');?> </div>
			<div class="grid_2 bt"><?php //echo form_submit('listar', 'Listar');?></div>
			<div class="clear"></div>
		</div>-->
		<?php //echo form_close(); ?>
		
		
		<?php echo "<h5 align='center'id='container_paginacao' style='font-size:12px'>".$pagination_helper->create_links()."<h5>"; ?>
		<div class="esp prefix_1 grid_22">
			<?php if($total): ?>
			<table width="100%" cellpadding="5">
				<thead>
					<tr>
						<!--<td width="10">ID</td>-->
						<td><?php echo utf8_encode('Usuário'); ?></td>
						<td><?php echo utf8_encode('Nível'); ?></td>
						<td>Email</td>
						<?php if($_SESSION['nivel'] == 1): ?>
						<td width="10"><?php echo img(array('src' => 'media/img/edit.png', 'title' => 'editar')); ?></td>
						<td width="10"><?php echo img(array('src' => 'media/img/delete.png', 'title' => 'excluir')); ?></td>
						<?php endif;?>
							
							
						</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($query as $line => $row):?>
					<tr	class="<?php echo ( $line % 2 ) ? 'tr_c1' : 'tr_c2'; ?>">
						<!--<td><?php //echo $row->id; ?></td>-->
						<td><?php echo $row->usuario; ?></td>
						<td><?php echo $row->nivel; ?></td>
						<td><?php echo $row->email; ?></td>
						<?php if($_SESSION['nivel'] == 1): ?>
						<td><?php echo anchor('editar/' . $this->uri->segment(2) . '/' . $row->id_login, img(array('src' => 'media/img/edit.png', 'title' => 'editar')))?></td>
						<td><?php echo anchor('excluir/' . $this->uri->segment(2) . '/' . $row->id_login, img(array('src' => 'media/img/delete.png', 'title' => 'excluir')), array('class' => 'del')); ?></td>
						<?php endif;?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php else: ?>
			<div class="esp2">
				<div class="grid_20 prefix_1"><div class="title">nenhum registro encontrado.</div></div>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
		<?php //$this->load->view('listar/paginacao'); ?>
		<?php echo "<h5 align='center'id='container_paginacao'>".$pagination_helper->create_links()."<h5>"; ?>
		<?php echo "<h5 align='center'>".$total." registros encontrados</h5>"; ?>
	</div>
	
</div>
