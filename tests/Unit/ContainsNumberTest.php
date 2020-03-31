<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class ContainsNumberTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::containsNumber($input));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::containsNumber($input));
	}


	public function provideValidInput(): array
	{
		return [
			['+420 543 236 506'],
			['abc3dce'],
			['Purkyňova 2'],
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['##'],
			['blbost'],
			['\n  '],
		];
	}
}

(new ContainsNumberTest())->run();
