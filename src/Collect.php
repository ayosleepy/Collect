<?php
namespace Collect;

class Collect
{
    private array $array = [];

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    public function get($key = null)
    {
        return $this->array[$key] ?? $this->array;
    }

    public function first()
    {
        return $this->array[array_key_first($this->array)];
    }

    public function count(): int
    {
        return count($this->array);
    }

    public function toArray(): array
    {
        return $this->array;
    }

    public function map(callable $callback): Collect
    {
        return new self(array_map($callback, $this->array));
    }

    public function each(callable $callback, ...$args): Collect
    {
        foreach ($this->array as $key => $item) {
            $callback($item, $key, ...$args);
        }
        return $this;
    }

    public function push($value, $key = null): Collect
    {
        if (gettype($value) === 'array') {
            $value = new self($value);
        }
        if ($key) {
            $this->array[$key] = $value;
        } else {
            $this->array[] = $value;
        }
        return $this;
    }

    public function unshift($value): Collect
    {
        array_unshift($this->array, $value);
        return $this;
    }

    public function shift(): Collect
    {
        array_shift($this->array);
        return $this;
    }

    public function pop(): Collect
    {
        array_pop($this->array);
        return $this;
    }

    public function filter(callable $callback): Collect
    {
        return new self(array_filter($this->array, $callback));
    }

    public function pluck(string $key): Collect
    {
        return new self(array_column($this->array, $key));
    }

    public function sum(?string $key = null)
    {
        if ($key) {
            return array_sum(array_column($this->array, $key));
        }
        return array_sum($this->array);
    }

    public function unique(): Collect
    {
        return new self(array_unique($this->array));
    }
}