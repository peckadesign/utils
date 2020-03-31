<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IsDateTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isDate($input));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isDate($input));
	}


	public function provideValidInput(): array
	{
		return [
			['1970-01-01'],
			['3783-05-12'],
			['1200-11-01'],
			['9993-11-01'],
			['2020-02-29'],
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['1.1.1970'],
			['983-01-09'],
			['1200-13-01'],
			['5. Mar, 1262'],
			['2020-03-32'],
			['10020-03-30'],
		];
	}
}

(new IsDateTest())->run();
