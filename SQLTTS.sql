-- MySQL Script generated by MySQL Workbench
-- Thu Oct 28 18:18:43 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `idusers` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(80) NOT NULL,
  `lname` VARCHAR(80) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `password` VARCHAR(150) NOT NULL,
  `entreprise` TINYINT NOT NULL DEFAULT 'False',
  `entname` VARCHAR(255) NULL,
  PRIMARY KEY (`idusers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Party`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Party` (
  `idParty` INT NOT NULL AUTO_INCREMENT,
  `Title` VARCHAR(255) NOT NULL,
  `Description` LONGTEXT NOT NULL,
  `Date` DATE NOT NULL,
  `Ville` VARCHAR(255) NOT NULL,
  `Département` VARCHAR(255) NOT NULL,
  `Ouvert` TINYINT NOT NULL,
  PRIMARY KEY (`idParty`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`PartyJoin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`PartyJoin` (
  `idPartyJoin` INT NOT NULL AUTO_INCREMENT,
  `Id_user` INT NOT NULL,
  `Id_party` INT NOT NULL,
  `Accepted` TINYINT NOT NULL DEFAULT 'False',
  `Fav` TINYINT NOT NULL DEFAULT 'False',
  PRIMARY KEY (`idPartyJoin`),
  INDEX `fk_PartyJoin_users_idx` (`Id_user` ASC),
  INDEX `fk_PartyJoin_Party1_idx` (`Id_party` ASC),
  CONSTRAINT `fk_PartyJoin_users`
    FOREIGN KEY (`Id_user`)
    REFERENCES `mydb`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PartyJoin_Party1`
    FOREIGN KEY (`Id_party`)
    REFERENCES `mydb`.`Party` (`idParty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Fourniture`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Fourniture` (
  `idFourniture` INT NOT NULL,
  `user` INT NOT NULL,
  `party` INT NOT NULL,
  `Contenu` TEXT NOT NULL,
  PRIMARY KEY (`idFourniture`),
  INDEX `fk_Fourniture_users1_idx` (`user` ASC),
  INDEX `fk_Fourniture_Party1_idx` (`party` ASC),
  CONSTRAINT `fk_Fourniture_users1`
    FOREIGN KEY (`user`)
    REFERENCES `mydb`.`users` (`idusers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fourniture_Party1`
    FOREIGN KEY (`party`)
    REFERENCES `mydb`.`Party` (`idParty`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
