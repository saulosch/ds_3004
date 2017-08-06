<div class="table-responsive">
	<h1><?php echo (isset($title))?$title:'Lista das Atividades';?></h1>
	<table class="table" id="tabela_atividades">
		<thead>
			<tr>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Data de Início</th>
				<th>Data de Fim</th>
				<th>Status</th>
				<th>Situação</th>
				<th></th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th>
					<select id="status_filter" class="filter" name="status_filter" onchange="filterTable('tabela_atividades')">
			  			<option value="" selected>-</option>
			  			<?php foreach ($statuses as $status) : ?>
			  				<option value="<?=$status?>"><?=$status?></option>
			  			<?php endforeach; ?>
					</select> 
				</th>
				<th>
					<select id="situacao_filter" class="filter" name="situacao_filter" onchange="filterTable('tabela_atividades')">
			  			<option value="" selected>-</option>
			  			<option value="Ativo">Ativo</option>
			  			<option value="Inativo">Inativo</option>
					</select> 
					</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($atividades as $atividade) : ?>
				<tr class="<?php echo ( $atividade->getStatus()->getIdStatus() == 4 ) ? 'success' : ''; ?>">
					<td><?php echo $atividade->getNomeAtividade(); ?></td>
					<td><?php echo $atividade->getDescricaoAtividade(); ?></td>
					<td><?php echo DateTime::createFromFormat('Y-m-d', 
						$atividade->getDataInicio())->format('d/m/Y'); ?></td>
					<td><?php echo ($atividade->getDataFim() != 0) ? 
						DateTime::createFromFormat('Y-m-d',
						$atividade->getDataFim())->format('d/m/Y') : ''; ?></td>
					<td class='filtered' filteredby='status_filter'><?php echo $atividade->getStatus()->getNomeStatus();?></td>
					<td class='filtered' filteredby='situacao_filter'><?php echo ( $atividade->getSituacao() ) ? 'Ativo' : 'Inativo'; ?></td>
					
					<td>
						<?php if ($atividade->getStatus()->getIdStatus() != 4): ?>
							<a href="<?=SITE_URL.'/edita?id='.$atividade->getIdAtividade();?>" class="btn btn-default btn-xs" role="button">Editar</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class='text-right'>
	<a href="<?=SITE_URL.'/adiciona'?> " class="btn btn-primary" role="button">Criar nova atividade</a>
</div>
