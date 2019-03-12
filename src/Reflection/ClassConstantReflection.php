<?php declare(strict_types = 1);

namespace PHPStan\Reflection;

class ClassConstantReflection implements ConstantReflection, DeprecatableReflection, InternableReflection
{

	/** @var \PHPStan\Reflection\ClassReflection */
	private $declaringClass;

	/** @var \ReflectionClassConstant */
	private $reflection;

	/** @var string|null */
	private $deprecatedDescription;

	/** @var bool */
	private $isDeprecated;

	/** @var bool */
	private $isInternal;

	public function __construct(
		ClassReflection $declaringClass,
		\ReflectionClassConstant $reflection,
		?string $deprecatedDescription,
		bool $isDeprecated,
		bool $isInternal
	)
	{
		$this->declaringClass = $declaringClass;
		$this->reflection = $reflection;
		$this->deprecatedDescription = $deprecatedDescription;
		$this->isDeprecated = $isDeprecated;
		$this->isInternal = $isInternal;
	}

	public function getName(): string
	{
		return $this->reflection->getName();
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->reflection->getValue();
	}

	public function getDeclaringClass(): ClassReflection
	{
		return $this->declaringClass;
	}

	public function isStatic(): bool
	{
		return true;
	}

	public function isPrivate(): bool
	{
		return $this->reflection->isPrivate();
	}

	public function isPublic(): bool
	{
		return $this->reflection->isPublic();
	}

	public function isDeprecated(): bool
	{
		return $this->isDeprecated;
	}

	public function getDeprecatedDescription(): ?string
	{
		if ($this->isDeprecated) {
			if ($this->deprecatedDescription !== null && $this->deprecatedDescription !== '') {
				return $this->getName() . ' is deprecated ' . $this->deprecatedDescription;
			}
			return $this->getName() . ' is deprecated.';
		}

		return null;
	}

	public function isInternal(): bool
	{
		return $this->isInternal;
	}

}
