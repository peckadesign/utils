<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IsTimeTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isTime($input));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isTime($input));
	}


	public function provideValidInput(): array
	{
		return [
			['12:35'],
			['0:53'],
			['23:09'],
			['4:23'],
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['0:12:'],
			['18:6'],
			['12:00:01'],
			['32:12'],
		];
	}
}

(new IsTimeTest())->run();
