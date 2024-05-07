-- MySQL Script generated by MySQL Workbench
-- Tue May  7 11:10:06 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbStage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbStage
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbStage` DEFAULT CHARACTER SET utf8 ;
USE `dbStage` ;

-- -----------------------------------------------------
-- Table `dbStage`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(25) NOT NULL,
  `last_name` VARCHAR(40) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `type` TINYINT NOT NULL,
  `account_status` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`branchs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`branchs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`status` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(23) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE)
ENGINE = InnoDB;

INSERT INTO `dbStage`.`status` (`name`) VALUES ('ouvert à l'inscription'), ('complet');


-- -----------------------------------------------------
-- Table `dbStage`.`internships`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`internships` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(500) NOT NULL,
  `start_date` DATE NOT NULL,
  `end date` DATE NOT NULL,
  `start_time` TIME NOT NULL,
  `end_time` TIME NOT NULL,
  `branchs_id` INT NOT NULL,
  `status_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) INVISIBLE,
  UNIQUE INDEX `Unique` (`start_date` ASC, `end date` ASC) INVISIBLE,
  INDEX `fk_internships_branchs_idx` (`branchs_id` ASC) VISIBLE,
  INDEX `fk_internships_status1_idx` (`status_id` ASC) VISIBLE,
  CONSTRAINT `fk_internships_branchs`
    FOREIGN KEY (`branchs_id`)
    REFERENCES `dbStage`.`branchs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internships_status1`
    FOREIGN KEY (`status_id`)
    REFERENCES `dbStage`.`status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`childs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`childs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(25) NOT NULL,
  `last_name` VARCHAR(40) NOT NULL,
  `Users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_childs_Users1_idx` (`Users_id` ASC) VISIBLE,
  UNIQUE INDEX `Unique` (`first_name` ASC, `last_name` ASC) VISIBLE,
  CONSTRAINT `fk_childs_Users1`
    FOREIGN KEY (`Users_id`)
    REFERENCES `dbStage`.`Users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`childs_register_internships`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`childs_register_internships` (
  `childs_id` INT NOT NULL,
  `internships_id` INT NOT NULL,
  INDEX `fk_childs_has_internships_internships1_idx` (`internships_id` ASC) VISIBLE,
  INDEX `fk_childs_has_internships_childs1_idx` (`childs_id` ASC) VISIBLE,
  CONSTRAINT `fk_childs_has_internships_childs1`
    FOREIGN KEY (`childs_id`)
    REFERENCES `dbStage`.`childs` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_childs_has_internships_internships1`
    FOREIGN KEY (`internships_id`)
    REFERENCES `dbStage`.`internships` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`teachers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(25) NOT NULL,
  `last_name` VARCHAR(40) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbStage`.`internships_animate_teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbStage`.`internships_animate_teachers` (
  `internships_id` INT NOT NULL,
  `teachers_id` INT NOT NULL,
  INDEX `fk_internships_has_teachers_teachers1_idx` (`teachers_id` ASC) VISIBLE,
  INDEX `fk_internships_has_teachers_internships1_idx` (`internships_id` ASC) VISIBLE,
  CONSTRAINT `fk_internships_has_teachers_internships1`
    FOREIGN KEY (`internships_id`)
    REFERENCES `dbStage`.`internships` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internships_has_teachers_teachers1`
    FOREIGN KEY (`teachers_id`)
    REFERENCES `dbStage`.`teachers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
-- Ajout de données dans la table `branchs`
INSERT INTO `dbStage`.`branchs` (`name`) VALUES ('Branch 1'), ('Branch 2'), ('Branch 3'), ('Branch 4'), ('Branch 5');


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

