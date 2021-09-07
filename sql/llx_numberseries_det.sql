-- Copyright (C) 2014      Juanjo Menent        <jmenent@2byte.es>
--
-- This program is free software: you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation, either version 3 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.

CREATE TABLE llx_numberseries_det
(
	rowid 					integer AUTO_INCREMENT PRIMARY KEY,
	fk_serie 				integer NOT NULL,
	mask_1		 			varchar(30),
	mask_2 					varchar(30),
	mask_3 					varchar(30),
	mask_4 					varchar(30),
	mask_5 					varchar(30),
	mask_6 					varchar(30),
	mask_7 					varchar(30),
	mask_8 					varchar(30),
	mask_9 					varchar(30)
	
)ENGINE=innodb;

ALTER TABLE `llx_numberseries_det` 
ADD `mask_5` VARCHAR(30) NOT NULL AFTER `mask_4`, 
ADD `mask_6` VARCHAR(30) NOT NULL AFTER `mask_5`, 
ADD `mask_7` VARCHAR(30) NOT NULL AFTER `mask_6`, 
ADD `mask_8` VARCHAR(30) NOT NULL AFTER `mask_7`, 
ADD `mask_9` VARCHAR(30) NOT NULL AFTER `mask_8`;