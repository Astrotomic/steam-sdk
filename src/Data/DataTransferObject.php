<?php

namespace Astrotomic\SteamSdk\Data;

use ArrayAccess;
use Astrotomic\SteamSdk\Collections\Collection;
use BackedEnum;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Str;
use JsonSerializable;
use LogicException;
use ReflectionClass;
use TypeError;

abstract class DataTransferObject implements Arrayable, Jsonable, JsonSerializable, ArrayAccess
{
    public static function fromArray(array $data): static
    {
        $data = collect($data)
            ->keyBy(fn (mixed $value, string $key): string => Str::lower($key))
            ->all();

        $class = new ReflectionClass(static::class);
        $properties = $class->getProperties();

        $arguments = [];

        foreach ($properties as $property) {
            $type = $property->getType();
            $cast = $type?->getName() ?? 'string';

            $value = data_get($data, $property->getName());

            if ($type->allowsNull() && blank($value)) {
                $arguments[$property->getName()] = null;

                continue;
            }

            if (enum_exists($cast) && in_array(BackedEnum::class, class_implements($cast), true)) {
                $arguments[$property->getName()] = $cast::from($value);

                continue;
            }

            if (! class_exists($cast)) {
                $arguments[$property->getName()] = match ($cast) {
                    'bool' => (bool) $value,
                    'int' => (int) $value,
                    'float' => (float) $value,
                    default => $value,
                };

                continue;
            }

            if (is_subclass_of($cast, Collection::class)) {
                $arguments[$property->getName()] = $cast::fromArray($value ?? []);

                continue;
            }

            if (is_subclass_of($cast, static::class)) {
                $arguments[$property->getName()] = $value ? $cast::fromArray($value) : null;

                continue;
            }

            if (in_array(CarbonInterface::class, class_implements($cast), true)) {
                if (is_int($value)) {
                    $arguments[$property->getName()] = $cast::createFromTimestamp($value);
                } else {
                    $arguments[$property->getName()] = $cast::make($value);
                }

                continue;
            }

            throw new TypeError("[{$type}] is an existing class but not handled by DataTransferObject::fromArray() implementation.");
        }

        return new static(...$arguments);
    }

    public function toArray(): array
    {
        return collect(get_object_vars($this))
            ->filter(fn (mixed $value): bool => filled($value))
            ->map(fn (mixed $value): mixed => $value instanceof CarbonInterface ? $value->toDateString() : $value)
            ->map(fn (mixed $value): mixed => $value instanceof BackedEnum ? $value->value : $value)
            ->toArray();
    }

    public function toJson($options = 0): string
    {
        return json_encode($this, JSON_THROW_ON_ERROR | $options);
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function offsetExists(mixed $offset): bool
    {
        return property_exists($this, $offset);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return property_exists($this, $offset)
            ? $this->$offset
            : null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $class = $this::class;

        throw new LogicException("Impossible to set 'readonly' property [{$offset}] on DTO [{$class}].");
    }

    public function offsetUnset(mixed $offset): void
    {
        $class = $this::class;

        throw new LogicException("Impossible to unset 'readonly' property [{$offset}] on DTO [{$class}].");
    }
}
