<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IsPhoneTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isPhone($input));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isPhone($input));
	}


	public function provideValidInput(): array
	{
		return [
			['+420 543 236 506'],
			['+420543236506'],
			['+420543 236 506'],
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['CZ26266644'],
			['blbost'],
			['12345678'],
			['\n  '],
			['+420043236506'],
			['420043236506'],
		];
	}
}

(new IsPhoneTest())->run();
