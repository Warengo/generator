<?php declare(strict_types = 1);

namespace Warengo\Generator;

use Exception;
use Faker\Factory;
use Faker\Generator as FakerGenerator;

final class Generator
{

	private const LIMIT = 100;

	private FakerGenerator $generator;

	private bool $bool = true;

	private RandomizerInterface $randomizer;

	/** @var mixed[] */
	private $registry = [];

	public function __construct(?FakerGenerator $generator = null, ?RandomizerInterface $randomizer = null)
	{
		$this->generator = $generator ?? self::createFaker();
		$this->randomizer = $randomizer ?? new BuiltInRandomizer();
	}

	public static function createFaker(): FakerGenerator
	{
		return Factory::create();
	}

	public function uniqueEmail(): string
	{
		return $this->unique('email');
	}

	public function uniqueBool(): bool
	{
		return $this->bool = !$this->bool;
	}

	public function branch(): string
	{
		return $this->randomOf([
			'IT',
			'Food',
			'Education',
			'Chemical',
			'Mining',
			'Textiles',
			'Transport',
		]);
	}

	/**
	 * @param mixed $value
	 * @return mixed|null
	 */
	public function nullable($value, int $nullPossibility = 50)
	{
		if ($this->randomizer->random(0, 100) < $nullPossibility) {
			return null;
		}

		return $value;
	}

	public function toNick(string $name): string
	{
		return Utilities::convertToNickname($name);
	}

	public function once(): Once
	{
		return new Once();
	}

	/**
	 * @return mixed
	 */
	protected function unique(string $getter)
	{
		$limit = self::LIMIT;
		do {
			$value = $this->generator->$getter;
			$limit--;
			if ($limit === -1) {
				throw new Exception('Maximum call exceeded');
			}
		} while (isset($this->registry[$getter][$value]));

		$this->registry[$getter][$value] = true;

		return $value;
	}

	/**
	 * @param mixed[] $possibles
	 * @return mixed
	 */
	protected function randomOf(array $possibles)
	{
		return $possibles[$this->randomizer->random(0, count($possibles) - 1)];
	}

}
