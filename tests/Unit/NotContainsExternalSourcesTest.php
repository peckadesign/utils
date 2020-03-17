<?php declare(strict_types = 1);

namespace PdTests\Unit;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class NotContainsExternalSourcesTest extends \Tester\TestCase
{
	/**
	 * @dataProvider provideValidRobots
	 */
	public function testValid(string $input): void
	{
		\Tester\Assert::true(\Pd\Utils\Validators::notContainsExternalSources($input));
	}


	/**
	 * @dataProvider provideInvalidRobots
	 */
	public function testInvalid(string $input): void
	{
		\Tester\Assert::false(\Pd\Utils\Validators::notContainsExternalSources($input));
	}


	public function provideValidRobots(): array
	{
		return [
			['Lorem ipsum dolor sit amet, consectetuer adipiscing elit.'],
			['1234567'],
			["<img src='https:"],
			['<script src=`/my.js`'],
			['<img src=https://bart.simpson.edu/ass.jpg'],
		];
	}


	public function provideInvalidRobots(): array
	{
		return [
			['<img src="http://cdn.benu.cz/images/landing-page/9/35589.png " width="140" />'],
			['<script src=`http://panick.attack.gov` />'],
			['<script src=http'],
		];
	}
}

(new NotContainsExternalSourcesTest())->run();
