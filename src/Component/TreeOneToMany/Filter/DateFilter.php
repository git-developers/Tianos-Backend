<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Filter;

use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Filtering\FilterInterface;

final class DateFilter implements FilterInterface
{
    public const NAME = 'date';
    public const DEFAULT_INCLUSIVE_FROM = true;
    public const DEFAULT_INCLUSIVE_TO = false;

    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        $expressionBuilder = $dataSource->getExpressionBuilder();

        $field = (string) $this->getOption($options, 'field', $name);

        $from = isset($data['from']) ? $this->getDateTime($data['from']) : null;
        if (null !== $from) {
            $inclusive = (bool) $this->getOption($options, 'inclusive_from', self::DEFAULT_INCLUSIVE_FROM);
            if (true === $inclusive) {
                $expressionBuilder->greaterThanOrEqual($field, $from);
            } else {
                $expressionBuilder->greaterThan($field, $from);
            }
        }

        $to = isset($data['to']) ? $this->getDateTime($data['to']) : null;
        if (null !== $to) {
            $inclusive = (bool) $this->getOption($options, 'inclusive_to', self::DEFAULT_INCLUSIVE_TO);
            if (true === $inclusive) {
                $expressionBuilder->lessThanOrEqual($field, $to);
            } else {
                $expressionBuilder->lessThan($field, $to);
            }
        }
    }

    /**
     * @param array $options
     * @param string $name
     * @param mixed $default
     *
     * @return mixed
     */
    private function getOption(array $options, string $name, $default)
    {
        return $options[$name] ?? $default;
    }

    /**
     * @param string[] $data
     *
     * @return string|null
     */
    private function getDateTime(array $data): ?string
    {
        if (empty($data['date'])) {
            return null;
        }

        if (empty($data['time'])) {
            return $data['date'];
        }

        return $data['date'] . ' ' . $data['time'];
    }
}
