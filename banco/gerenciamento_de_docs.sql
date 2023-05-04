-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gerenciamento_de_docs
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gerenciamento_de_docs
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gerenciamento_de_docs` DEFAULT CHARACTER SET utf8 ;
USE `gerenciamento_de_docs` ;

-- -----------------------------------------------------
-- Table `gerenciamento_de_docs`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerenciamento_de_docs`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gerenciamento_de_docs`.`documentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerenciamento_de_docs`.`documentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `data_upload` DATE NOT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_documentos_usuarios_idx` (`usuarios_id` ASC) VISIBLE,
  CONSTRAINT `fk_documentos_usuarios`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `gerenciamento_de_docs`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gerenciamento_de_docs`.`compartilhamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerenciamento_de_docs`.`compartilhamento` (
  `usuarios_id` INT NOT NULL,
  `documentos_id` INT NOT NULL,
  `visualizar` TINYINT NULL,
  `editar` TINYINT NULL,
  `excluir` TINYINT NULL,
  PRIMARY KEY (`usuarios_id`, `documentos_id`),
  INDEX `fk_usuarios_has_documentos_documentos1_idx` (`documentos_id` ASC) VISIBLE,
  INDEX `fk_usuarios_has_documentos_usuarios1_idx` (`usuarios_id` ASC) VISIBLE,
  CONSTRAINT `fk_usuarios_has_documentos_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `gerenciamento_de_docs`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_has_documentos_documentos1`
    FOREIGN KEY (`documentos_id`)
    REFERENCES `gerenciamento_de_docs`.`documentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
