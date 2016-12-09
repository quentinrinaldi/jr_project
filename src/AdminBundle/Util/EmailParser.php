<?php
namespace AdminBundle\Util;

class EmailParser {

public function parseText($textToParse, Array $wordsMatcher) {
	$keys = array_keys ($wordsMatcher);
	$values = array_values($wordsMatcher);

	return str_replace($keys, $values, $textToParse); 
}

}