-- -----------------------------------------------------
-- Schema ds_3004
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ds_3004` ;

-- -----------------------------------------------------
-- Schema ds_3004
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ds_3004` DEFAULT CHARACTER SET utf8 ;
USE `ds_3004` ;

-- -----------------------------------------------------
-- Table `status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `status` ;

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` INT NOT NULL AUTO_INCREMENT,
  `nome_status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_status`))
ENGINE = InnoDB;

INSERT INTO `status` (`id_status`,`nome_status`) VALUES (1, 'Pendente');
INSERT INTO `status` (`id_status`,`nome_status`) VALUES (2, 'Em Desenvolvimento');
INSERT INTO `status` (`id_status`,`nome_status`) VALUES (3, 'Em Teste');
INSERT INTO `status` (`id_status`,`nome_status`) VALUES (4, 'Concluído');

-- -----------------------------------------------------
-- Table `atividade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `atividade` ;

CREATE TABLE IF NOT EXISTS `atividade` (
  `id_atividade` INT NOT NULL AUTO_INCREMENT,
  `nome_atividade` VARCHAR(255) NOT NULL,
  `descricao_atividade` VARCHAR(600) NOT NULL,
  `data_inicio` DATE NOT NULL,
  `data_fim` DATE NULL,
  `fk_status_id_status` INT NOT NULL,
  `situacao` TINYINT NOT NULL,
  PRIMARY KEY (`id_atividade`),
  CONSTRAINT `fk_atividade_status`
    FOREIGN KEY (`fk_status_id_status`)
    REFERENCES `status` (`id_status`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_atividade_status_idx` ON `atividade` (`fk_status_id_status` ASC);


-- -----------------------------------------------------
-- STORED PROCEDURES
-- -----------------------------------------------------

DROP PROCEDURE IF EXISTS prc_insere_atividade;

DELIMITER $$
CREATE PROCEDURE prc_insere_atividade (
                            IN p_nome_atividade VARCHAR(255),
                            IN p_descricao_atividade VARCHAR(600),
                            IN p_data_inicio DATE,
                            IN p_data_fim DATE,
                            IN p_status INT,
                            IN p_situacao TINYINT) 
BEGIN
  INSERT INTO atividade (nome_atividade, descricao_atividade, data_inicio, 
    data_fim, fk_status_id_status, situacao)
  VALUES ( p_nome_atividade, p_descricao_atividade, p_data_inicio, p_data_fim,
    p_status, p_situacao);
END $$
DELIMITER ;

-- 

DROP PROCEDURE IF EXISTS prc_atualiza_atividade;

DELIMITER $$
CREATE PROCEDURE prc_atualiza_atividade (
                            IN p_id_atividade INT,
                            IN p_nome_atividade VARCHAR(255),
                            IN p_descricao_atividade VARCHAR(600),
                            IN p_data_inicio DATE,
                            IN p_data_fim DATE,
                            IN p_status INT,
                            IN p_situacao TINYINT) 
BEGIN
  UPDATE atividade 
  SET 
  nome_atividade = p_nome_atividade, 
  descricao_atividade = p_descricao_atividade, 
  data_inicio = p_data_inicio, 
  data_fim = p_data_fim, 
  fk_status_id_status = p_status, 
  situacao = p_situacao
  WHERE id_atividade = p_id_atividade;
END $$
DELIMITER ;

-- 