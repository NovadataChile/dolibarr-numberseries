<?php
/* Copyright (C) 2014      Juanjo Menent		<jmenent@2byte.es>
 * Copyright (C) 2015      Ferran Marcet		<fmarcet@2byte.es>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * or see http://www.gnu.org/
 */

/**
 *	\file       /numberseries/core/modules/facture/mod_facture_numberseries.php
 *	\ingroup    facture
 *	\brief      File containing class for numbering module Numberseries
 */
require_once DOL_DOCUMENT_ROOT .'/core/modules/project/modules_project.php';


/**
 *	\class      mod_facture_mercure
 *	\brief      Classe du modele de numerotation de reference de facture Mercure
 */
class mod_project_numberseries extends ModeleNumRefProjects
{
	public $version='dolibarr';		// 'development', 'experimental', 'dolibarr'
    public $error = '';
    public $nom = 'Numberseries';
    public $module = 'project';

    /**
     *  Return description of module
     *
     *  @return     string      Texte descripif
     */
	public function info()
    {
    	global $conf,$langs;

        $langs->load("bills");
        $langs->load("numberseries@numberseries");

        $urlMod = dol_buildpath("/numberseries/admin/admin.php",1);
        $texte = $langs->trans("GoToNumberseriesConf",$urlMod);
        
        return $texte;
    }

    /**
     *  Renvoi un exemple de numerotation
     *
     *  @return     string      Example
     */
    public function getExample($rowid = null)
    {
     	global $conf,$langs,$mysoc;

    	$old_code_client=$mysoc->code_client;
    	$old_code_type=$mysoc->typent_code;
    	$mysoc->code_client='CCCCCCCCCC';
    	$mysoc->typent_code='TTTTTTTTTT';
     	$numExample = $this->getNextValue($mysoc,'', $rowid);
        $object = null;
     	$object->array_options['options_serie'] = (empty($serie)?"":$serie);
		$mysoc->code_client=$old_code_client;
		$mysoc->typent_code=$old_code_type;

		if (! $numExample)
		{
			$numExample = 'NotConfigured';
		}
		return $numExample;
    }

	/**
	 *  Return next value
	 *
	 *  @param	Societe		$objsoc     Object third party
	 * 	@param	Propal		$project		Object commercial proposal
	 *  @return string      			Value if OK, 0 if KO
	 */
    public function getNextValue($objsoc,$project,$serie_id = null)
	{
		global $db,$conf,$langs;

		require_once DOL_DOCUMENT_ROOT .'/core/lib/functions2.lib.php';
		dol_include_once("/numberseries/class/numberseries.class.php");

		// Get Mask value
        $mask = '';
        $serie = new Numberseries($db);
        $serie_id = ((!empty($serie_id)) ? $serie_id : $project->array_options['options_serie']);
        if(empty($serie_id)){
        	$serie_id = $serie->getDefault(6);
        }
        
        $serie->fetch($serie_id);
        $serie->fetch_lines();
        
        $mask=$serie->lines[0]->mask_1;

		if (! $mask)
		{
			$this->error='NotConfigured';
			return 0;
		}

		$date=$project->date;
		$customercode=$objsoc->code_client;
		$numFinal=get_next_value($db,$mask,'projet','ref','',$objsoc,$date);
        if($numFinal === 'ErrorBadMask') $numFinal = $langs->trans($numFinal);

		return  $numFinal;
	}

}

