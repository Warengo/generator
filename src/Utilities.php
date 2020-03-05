<?php declare(strict_types = 1);

namespace Warengo\Generator;

use Nette\Utils\Strings;

final class Utilities
{

	public static function convertToNickname(string $string): string
	{
		$string = Strings::firstLower(Strings::toAscii($string));
		$string = preg_replace('#[^a-z0-9]+#i', '', $string);

		return (string) $string;
	}

}
