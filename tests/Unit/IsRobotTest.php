<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class IsRobotTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidRobots
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::isRobot($input));
	}


	/**
	 * @dataProvider provideInvalidRobots
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::isRobot($input));
	}


	public function provideValidRobots(): array
	{
		return [
			['alexa'],
			['google'],
			['yahoo'],
			['facebook'],
		];
	}


	public function provideInvalidRobots(): array
	{
		return [
			['CZ26266644'],
			['blbost'],
			['12345678'],
			['\n  ']
		];
	}
}

(new IsRobotTest())->run();
