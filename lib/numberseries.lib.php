<?php
/* Copyright (C) 2014-2015	Ferran Marcet	<fmarcet@2byte.es>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 *	\file		lib/mymodule.lib.php
 *	\ingroup	mymodule
 *	\brief		This file is an example module library
 *				Put some comments here
 */

function numberseriesAdminPrepareHead()
{
	global $langs, $conf;

	$langs->load("numberseries@numberseries");

	$h = 0;
	$head = array();

	$head[$h][0] = dol_buildpath("/numberseries/admin/admin.php", 1);
	$head[$h][1] = $langs->trans("Settings");
	$head[$h][2] = 'settings';
	$h++;
	$head[$h][0] = dol_buildpath("/numberseries/admin/about.php", 1);
	$head[$h][1] = $langs->trans("About");
	$head[$h][2] = 'about';
	$h++;

	// Show more tabs from modules
	// Entries must be declared in modules descriptor with line
	//$this->tabs = array(
	//	'entity:+tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__'
	//); // to add new tab
	//$this->tabs = array(
	//	'entity:-tabname:Title:@mymodule:/mymodule/mypage.php?id=__ID__'
	//); // to remove a tab
    $object = null;
	complete_head_from_modules($conf, $langs, $object, $head, $h, 'numberseries');

	return $head;
}

/**
 *  Return a HTML select list of bank accounts
 *
 *  @param  string	$htmlname          	Name of select zone
 *  @param	string	$dictionarytable	Dictionary table
 *  @param	string	$keyfield			Field for key
 *  @param	string	$labelfield			Label field
 *  @param	string	$selected			Selected value
 *  @param  int		$useempty          	1=Add an empty value in list, 2=Add an empty value in list only if there is more than 2 entries.
 *  @param  string  $moreattrib         More attributes on HTML select tag
 * 	@return	void
 */
function select_typedoc($htmlname,$selected='',$useempty=0,$moreattrib='')
{
	global $langs, $conf, $db;

	$langs->load("admin");
	$langs->load("bills");
	
	$i = 1;
	$num = 5;
	print '<select id="select'.$htmlname.'" class="flat selectdictionary" name="'.$htmlname.'"'.($moreattrib?' '.$moreattrib:'').'>';
	if ($useempty == 1 || ($useempty == 2 && $num > 1))
	{
		print '<option value="-1">&nbsp;</option>';
	}

	while ($i <= $num)
	{
		if ($selected == $i)
		{
			print '<option value="'.$i.'" selected="selected">';
		}
		else
		{
			print '<option value="'.$i.'">';
		}
		print $langs->trans("NumberseriesDoc".$i);
		print '</option>';
		$i++;
	}
	print "</select>";
	
}