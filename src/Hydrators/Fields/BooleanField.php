<?php declare(strict_types = 1);

/**
 * BooleanField.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:JsonApi!
 * @subpackage     Hydrators
 * @since          0.1.0
 *
 * @date           26.05.20
 */

namespace FastyBird\JsonApi\Hydrators\Fields;

use IPub\JsonAPIDocument;

/**
 * Entity boolean field
 *
 * @package        FastyBird:JsonApi!
 * @subpackage     Hydrators
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
final class BooleanField extends Field
{

	/** @var bool */
	private bool $isNullable;

	/**
	 * @param bool $isNullable
	 * @param string $mappedName
	 * @param string $fieldName
	 * @param bool $isRequired
	 * @param bool $isWritable
	 */
	public function __construct(
		bool $isNullable,
		string $mappedName,
		string $fieldName,
		bool $isRequired,
		bool $isWritable
	) {
		parent::__construct($mappedName, $fieldName, $isRequired, $isWritable);

		$this->isNullable = $isNullable;
	}

	/**
	 * @param JsonAPIDocument\Objects\IStandardObject<string, mixed> $attributes
	 *
	 * @return bool|null
	 */
	public function getValue(JsonAPIDocument\Objects\IStandardObject $attributes): ?bool
	{
		$value = $attributes->get($this->getMappedName());

		if ($value !== null) {
			return (bool) $value;

		} elseif ($this->isNullable) {
			return null;
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public function isNullable(): bool
	{
		return $this->isNullable;
	}

}
