<?php declare(strict_types = 1);

namespace Warengo\Generator;

class Once
{

	private bool $bool = false;

	public function bool(bool $needOnce): bool
	{
		if (!$this->bool) {
			$this->bool = true;

			return $needOnce;
		}

		return !$needOnce;
	}

}
