<?php declare(strict_types = 1);

namespace Warengo\Generator\Testing;

use Warengo\Generator\RandomizerInterface;

class FakeRandomizer implements RandomizerInterface
{

	private int $return = 0;

	public function setReturn(int $return): void
	{
		$this->return = $return;
	}

	public function random(int $min = 0, ?int $max = null): int
	{
		return $this->return;
	}

}
