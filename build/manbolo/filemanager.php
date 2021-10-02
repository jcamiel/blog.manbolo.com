<?php
namespace Manbolo;

class FileManager
{

/**
 * Enumerate files and Directory 
 *
 * @access	public
 * @param	string $directory directory to be enumerated
 * @param	string $filter regex used to filter item in directory
 * @return	array
 */
public static function enumerateAt($directory = '', $filter= '', $enumerate_hidden=TRUE)
{
	$files = array();
	$it =  opendir($directory);
	if (!$it) {
		echo 'Cannot list files for ' . $directory;
		return NULL;
	}
		
	while ($filename = readdir($it)){
		if ($filename != '.' && $filename != '..'  ){
			if ($filter=="" || preg_match($filter, $filename)) {
				if (!$enumerate_hidden AND preg_match('/^\./', $filename)){
				}
				else
					$files[] = $filename;
			}
			else 
				continue;
		}
	}
	sort( $files);
	return $files;
	}
}