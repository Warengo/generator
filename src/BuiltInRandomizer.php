<?php declare(strict_types = 1);

namespace Warengo\Generator;

final class BuiltInRandomizer implements RandomizerInterface
{

	public function random(int $min, int $max): int
	{
		return mt_rand($min, $max);
	}

}
