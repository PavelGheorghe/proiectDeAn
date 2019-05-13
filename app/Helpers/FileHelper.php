<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.04.2017
 * Time: 16:02
 */

namespace App\Helpers;


class FileHelper {
	public static function urigen($str, $replace = array(), $delimiter = '-') {

		$cyr = array('а', 'б', 'в', 'г', 'д', 'e', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у',
			'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У',
			'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ь', 'Ю', 'Я');
		$lat = array('a', 'b', 'v', 'g', 'd', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u',
			'f', 'h', 'ts', 'ch', 'sh', 'sht', 'a', 'y', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Zh',
			'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U',
			'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'Y', 'Yu', 'Ya');

		$str = str_replace($cyr, $lat, $str);

		setlocale(LC_ALL, 'en_US.UTF8');
		if (!empty($replace)) {
			$str = str_replace((array) $replace, ' ', $str);
		}

		$clean = preg_replace(array('/Ä/', '/Ö/', '/Ü/', '/ä/', '/ö/', '/ü/'), array('Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue'), $str);
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

		return $clean;
	}
}