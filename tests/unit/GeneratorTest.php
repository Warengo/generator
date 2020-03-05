<?php declare(strict_types = 1);

namespace Project\Tests;

use Codeception\Test\Unit;
use Warengo\Generator\Generator;
use Warengo\Generator\Testing\FakeRandomizer;

class GeneratorTest extends Unit
{

	private Generator $generator;

	protected function _before(): void
	{
		$this->generator = new Generator();
	}

	public function testNullable(): void
	{
		$generator = new Generator(null, $randomizer = new FakeRandomizer());

		$randomizer->setReturn(51);
		$this->assertSame('test', $generator->nullable('test'));

		$randomizer->setReturn(1);
		$this->assertNull($generator->nullable('test'));
	}

	public function testBool(): void
	{
		$this->assertFalse($this->generator->uniqueBool());
		$this->assertTrue($this->generator->uniqueBool());
		$this->assertFalse($this->generator->uniqueBool());
		$this->assertTrue($this->generator->uniqueBool());
		$this->assertFalse($this->generator->uniqueBool());
		$this->assertTrue($this->generator->uniqueBool());
	}

	public function testBranch(): void
	{
		$generator = new Generator(null, $randomizer = new FakeRandomizer());

		$this->assertSame('IT', $generator->branch());

		$randomizer->setReturn(1);
		$this->assertSame('Food', $generator->branch());
	}

	public function testEmail(): void
	{
		$registry = [];
		for ($i = 0; $i < 50; $i++) {
			$email = $this->generator->uniqueEmail();
			if (in_array($email, $registry)) {
				$this->fail('uniqueEmail is not unique');
			}

			$registry[] = $email;
		}
	}

	public function testToNick(): void
	{
		$this->assertSame('johnDoe', $this->generator->toNick('John Doe'));
	}

}
