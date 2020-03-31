<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class CzechCompanyIdentifierTest extends \Tester\TestCase
{

	/**
	 * @dataProvider provideValidIdentifiers
	 */
	public function testCzechCompanyIdentifierPassing(string $identifier): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isCzechCompanyIdentifier($identifier));
	}


	/**
	 * @dataProvider provideInvalidIdentifiers
	 */
	public function testCzechCompanyIdentifierFailing(string $identifier): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isCzechCompanyIdentifier($identifier));
	}


	public function provideValidIdentifiers(): array
	{
		return [
			['26266644'],
			['02652269'],
			['26168685'],
			['88114163'],
		];
	}


	public function provideInvalidIdentifiers(): array
	{
		return [
			['CZ26266644'],
			['blbost'],
			['12345678'],
			['\n  ']
		];
	}


}

(new \PdTests\Unit\CzechCompanyIdentifierTest())->run();
