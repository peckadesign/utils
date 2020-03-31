<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IsZipTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isZip($input));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isZip($input));
	}


	public function provideValidInput(): array
	{
		return [
			['012 34'],
			['60200'],
			['893 54'],
			['12001'],
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['1.1.1970'],
			['some string'],
			['60 200'],
			['1200a'],
		];
	}
}

(new IsZipTest())->run();
