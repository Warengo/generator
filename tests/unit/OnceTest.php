<?php declare(strict_types = 1);

namespace Project\Tests;

use Codeception\Test\Unit;
use Warengo\Generator\Once;

class OnceTest extends Unit
{

	public function testBoolMethod(): void
	{
		$once = new Once();

		$this->assertTrue($once->bool(true));
		$this->assertFalse($once->bool(true));
		$this->assertFalse($once->bool(true));

		$this->assertTrue($once->bool(false));
	}

}
