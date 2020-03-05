<?php declare(strict_types = 1);

namespace Warengo\Generator;

interface RandomizerInterface
{

	public function random(int $min, int $max): int;

}
