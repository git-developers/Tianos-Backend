<?php

declare(strict_types=1);

namespace Component\TreeOneToMany;

final class Parameters
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->parameters;
    }

    /**
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->parameters);
    }

    /**
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $this->parameters[$key] : $default;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->parameters);
    }
}
