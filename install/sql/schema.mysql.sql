
CREATE  TABLE IF NOT EXISTS `%%PREFIX%%jediCounter` (
  `id_counter` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `scope` VARCHAR(20) NULL ,
  `value` INT UNSIGNED NOT NULL DEFAULT 0 ,
  `subject_id` INT NULL ,
  PRIMARY KEY (`id_counter`) ) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci;
  
CREATE  TABLE IF NOT EXISTS `%%PREFIX%%jediCounter_already` (
  `id_user` INT NOT NULL ,
  `id_counter` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_user`, `id_counter`) ,
  INDEX `fk_jediCounter_already_jediCounter` (`id_counter` ASC) ,
  CONSTRAINT `fk_jediCounter_already_jediCounter`
    FOREIGN KEY (`id_counter` )
    REFERENCES `jediCounter` (`id_counter` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci;