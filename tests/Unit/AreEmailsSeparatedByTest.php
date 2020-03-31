<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class AreEmailsSeparatedByTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidInput
	 */
	public function testValid(string $input, string $delimiter): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::areEmailsSeparatedBy($input, $delimiter));
	}


	/**
	 * @dataProvider provideInvalidInput
	 */
	public function testInvalid(string $input, string $delimiter): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::areEmailsSeparatedBy($input, $delimiter));
	}


	public function provideValidInput(): array
	{
		return [
			['bart@simpson.gov|lisa@simpson.edu|homer@simpson.au|marge@simpson.gr', '|'],
			['bart@simpson.gov &lisa@simpson.edu&homer@simpson.au& marge@simpson.gr', '&'],
			['one@email.cz', ','],
			['one@email.cz', ''],
			['one@email.cz\nsecond@email.cz', '\n'],
			['homer@simpson.au marge@simpson.gr', ' ']
		];
	}


	public function provideInvalidInput(): array
	{
		return [
			['bart@simpson.gov|lisa@simpson.edu|homer@simpson.au|marge@simpson.gr', '~'],
			['bart@simpson.gov,', ','],
			['bart@ simpson.gov|lisa@simpson.edu', '|'],
			['one@email.cz	second@email.cz', '\t'],
			['Lortem ipsum sit amet dolor', ' '],
		];
	}
}

(new AreEmailsSeparatedByTest())->run();
