<div class='row'>
	<div class="col-xs-12">
		<h1><?= (isset($title))?$title:'Manter Atividade';?></h1>
	</div>
	<?php if (isset($mensagem)): ?>
		<div class="col-xs-10 col-xs-offset-1 alert alert-<?= (isset($mensagem_tipo))?$mensagem_tipo:'danger'?>">
			<p><?=$mensagem?></p>
		</div>
	<?php endif ?>
	<?php if ($id_atividade !== false): ?>
		<form method='post' class="form-horizontal">
			
			<input type="hidden" name="id_atividade" value="<?=$id_atividade?>">
			
			<div class="form-group">
				<label for="nome_atividade" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Nome</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<input type="text" class="form-control" id="nome_atividade" name="nome_atividade" value="<?=$nome_atividade?>" maxlength="255" required >
				</div>
			</div>
			
			<div class="form-group">
				<label for="descricao_atividade" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Descrição</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<textarea id="descricao_atividade" name="descricao_atividade" class="form-control" cols="30" rows="4" maxlength="600" required><?=$descricao_atividade?></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="data_inicio" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Data de Início</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?= ($data_inicio != '') ? DateTime::createFromFormat('Y-m-d', $data_inicio)->format('d/m/Y'):''?>" required placeholder="dd/mm/aaaa" onblur="validarData(this)" >
				</div>
			</div>

			<div class="form-group">
				<label for="data_fim" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Data de Fim</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<input type="date" class="form-control" id="data_fim" name="data_fim" value="<?= ($data_fim != '') ? DateTime::createFromFormat('Y-m-d', $data_fim)->format('d/m/Y'):''?>" placeholder="dd/mm/aaaa"  onblur="validarData(this)">
				</div>
			</div>

			<div class="form-group">
				<label for="fk_status_id_status" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Status</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<select id="fk_status_id_status" class="form-control" name="fk_status_id_status" required>
			  			<?php foreach ($statuses as $key => $value) : ?>
			  				<option value="<?=$key?>" <?= ($key == $fk_status_id_status)?'selected':''?>><?=$value?></option>
			  			<?php endforeach; ?>
					</select> 
				</div>
			</div>

			<div class="form-group">
				<label for="situacao" class="col-xs-10 col-xs-offset-1 col-sm-2 control-label">Situação</label>
				<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-0">
					<select id="situacao" class="form-control" name="situacao" required>
			  			<option value="1" <?= ('1' === $situacao)?'selected':''?>>Ativo</option>
			  			<option value="0" <?= ('0' === $situacao)?'selected':''?>>Inativo</option>
					</select> 
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-10 col-xs-offset-1 text-right">
					<a href="<?=SITE_URL.'/lista'?> " class="btn btn-default" role="button">Voltar para a lista de atividades</a> 
					<?php if ($fk_status_id_status != 4 OR $data_fim == ''): ?>
						<input type="submit" class="btn btn-primary" name="salvar_atividade" value="Salvar">
					<?php endif; ?>
				</div>
			</div>
		</form>
	<?php endif; ?>
</div>