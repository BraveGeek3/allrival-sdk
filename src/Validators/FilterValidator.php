<?php

namespace AllrivalSDK\Validators;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use AllrivalSDK\Filters\FilterInterface;

class FilterValidator
{
    /**
     * @param array<FilterInterface> $filters
     * @return bool
     * @throws InvalidArgumentException
     */
    public static function validateFilters(array $filters): bool {
        foreach ($filters as $filter) {
            $className = get_class($filter);

            if (!($filter instanceof FilterInterface))
                throw new InvalidArgumentException("Invalid class provided as a filter:  $className");

            if ($filter->getValue() === '')
                throw new InvalidArgumentException("Empty value for filter $className");

            if (($type = $filter->getType()) !== '' &&
                !in_array($type, array_values($filter->getAllowedTypeValues()))
            )
                throw new InvalidArgumentException("Invalid filter value for $className. See \"FilterTypes\" folder for more details or call $className ->getAllowedTypeValues()");
        }

        return true;
    }
}