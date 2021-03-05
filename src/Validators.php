<?php declare(strict_types = 1);

namespace Pd\Utils;

final class Validators
{

	public const PHONE_PATTERN = '\+[0-9]{3} ?[1-9][0-9]{2} ?[0-9]{3} ?[0-9]{3}';
	public const PHONE_PATTERN_HU = '\+36 ?(([1-9]{1} ?[0-9]{3} ?[0-9]{4})|(([1-9]{1}[0-9]{1}[0-9]? ?[0-9]{3} ?[0-9]{3,4}))|([0-9]{3} ?[0-9]{2} ?[0-9]{3}))';
	public const CONTAINS_NUMBER_PATTERN = '\d+';
	public const NOT_CONTAINS_EXTERNAL_SOURCES = 'src=("|`|).*?(http(?!s))("|`|)';
	public const ZIP_PATTERN = '[0-9]{3} ?[0-9]{2}';


	private function __construct()
	{
	}


	public static function isRobot(string $userAgent): bool
	{
		$robotList = [
			'aspseek',
			'abachobot',
			'accoona',
			'acoirobot',
			'adsbot',
			'alexa',
			'alta vista',
			'altavista',
			'ask jeeves',
			'baidu',
			'crawler',
			'croccrawler',
			'dumbot',
			'estyle',
			'exabot',
			'fast-enterprise',
			'fast-webcrawler',
			'francis',
			'geonabot',
			'gigabot',
			'google',
			'heise',
			'heritrix',
			'ibm',
			'iccrawler',
			'idbot',
			'ichiro',
			'lycos',
			'msn',
			'msrbot',
			'majestic-12',
			'metager',
			'ng-search',
			'nutch',
			'omniexplorer',
			'psbot',
			'rambler',
			'seosearch',
			'scooter',
			'scrubby',
			'seekport',
			'sensis',
			'seoma',
			'snappy',
			'steeler',
			'synoo',
			'telekom',
			'turnitinbot',
			'voyager',
			'wisenut',
			'yacy',
			'yahoo',
			'bot',
			'slurp',
			'spider',
			'crawl',
			'archiver',
			'facebook',
		];

		foreach ($robotList as $robot) {
			if (\stripos($userAgent, $robot) !== FALSE) {
				return TRUE;
			}
		}

		return FALSE;
	}


	public static function isPhone(string $phone, string $pattern = self::PHONE_PATTERN): bool
	{
		return (bool) \preg_match('/^' . $pattern . '$/', $phone);
	}


	public static function containsNumber(string $input): bool
	{
		return (bool) \preg_match('/' . self::CONTAINS_NUMBER_PATTERN . '/', $input);
	}


	/**
	 * Checks whether input string DOESN'T contain src attributes with HTTP protocol inside to prevent content blocking
	 */
	public static function notContainsExternalSources(string $input): bool
	{
		\preg_match_all('/' . self::NOT_CONTAINS_EXTERNAL_SOURCES . '/', $input, $matches);

		if (empty($matches[2])) {
			return TRUE;
		}

		return FALSE;
	}


	public static function isTime(string $time): bool
	{
		if (\preg_match('/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/', $time) || \preg_match('/^([0-9]):([0-5][0-9])$/', $time)) {
			return TRUE;
		}

		return FALSE;
	}


	public static function isDate(string $date): bool
	{
		$dateArray = \explode('-', $date);
		if (\count($dateArray) === 3) {
			[$y, $m, $d] = $dateArray;

			if (\checkdate((int) $m, (int) $d, (int) $y) && \strtotime("$y-$m-$d") && \preg_match('#\b\d{2}[/-]\d{2}[/-]\d{4}\b#', "$d-$m-$y")) {
				return TRUE;
			}
		}

		return FALSE;
	}


	public static function areEmailsSeparatedBy(string $value, string $delimiter): bool
	{
		$atom = "[-a-z0-9!#$%&'*+/=?^_`{|}~]"; // RFC 5322 unquoted characters in local-part
		$alpha = "a-z\x80-\xFF"; // superset of IDN
		$pattern = "
			(\"([ !#-[\\]-~]*|\\\\[ -~])+\"|$atom+(\\.$atom+)*)  # quoted or unquoted
			@
			([0-9$alpha]([-0-9$alpha]{0,61}[0-9$alpha])?\\.)+    # domain - RFC 1034
			[$alpha]([-0-9$alpha]{0,17}[$alpha])?                # top domain
		";

		$delimiter = \preg_quote($delimiter);

		return (bool) \preg_match("<^{$pattern}(\s*{$delimiter}\s*{$pattern})*\\z>ix", $value);
	}


	public static function isZip(string $zip): bool
	{
		return (bool) \preg_match('/^' . self::ZIP_PATTERN . '$/', $zip);
	}


	public static function isCzechCompanyIdentifier(string $identifier): bool
	{
		$identifier = \preg_replace('#\s+#', '', $identifier);

		if ( ! $identifier || ! \preg_match('#^\d{8}$#', (string) $identifier)) {
			return FALSE;
		}

		$a = 0;
		for ($i = 0; $i < 7; $i++) {
			$a += (int) $identifier[$i] * (8 - $i);
		}

		$a = $a % 11;
		if ($a === 0) {
			$c = 1;
		} elseif ($a === 1) {
			$c = 0;
		} else {
			$c = 11 - $a;
		}

		return (int) $identifier[7] === $c;
	}

}
