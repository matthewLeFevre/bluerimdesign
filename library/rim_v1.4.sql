-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema rimdb
-- -----------------------------------------------------
-- Rim db is the name of the database model for blue rim desing

-- -----------------------------------------------------
-- Schema rimdb
--
-- Rim db is the name of the database model for blue rim desing
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rimdb` DEFAULT CHARACTER SET utf8 ;
USE `rimdb` ;

-- -----------------------------------------------------
-- Table `rimdb`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rimdb`.`user` ;

CREATE TABLE IF NOT EXISTS `rimdb`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  `joined` DATETIME NOT NULL,
  `status` ENUM('user', 'moderator', 'admin') NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rimdb`.`Topic`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rimdb`.`Topic` ;

CREATE TABLE IF NOT EXISTS `rimdb`.`Topic` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rimdb`.`post`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rimdb`.`post` ;

CREATE TABLE IF NOT EXISTS `rimdb`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titleWeb` VARCHAR(255) NOT NULL,
  `titleBlog` VARCHAR(255) NOT NULL,
  `iconPath` VARCHAR(255) NOT NULL,
  `date` DATETIME NOT NULL,
  `summary` TINYTEXT NOT NULL,
  `markup` MEDIUMTEXT NOT NULL,
  `status` ENUM('saved', 'published') NOT NULL,
  `videoEmbed` MEDIUMTEXT NULL,
  `videoUrl` MEDIUMTEXT NULL,
  `modified` DATETIME NULL,
  `user_id` INT NOT NULL,
  `Topic_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_user_idx` (`user_id` ASC),
  INDEX `fk_post_Topic1_idx` (`Topic_id` ASC),
  CONSTRAINT `fk_post_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `rimdb`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_post_Topic1`
    FOREIGN KEY (`Topic_id`)
    REFERENCES `rimdb`.`Topic` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
