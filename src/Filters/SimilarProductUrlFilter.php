<?php

namespace AllrivalSDK\Filters;

use AllrivalSDK\Filters\FilterTypes\MembershipFilter;

/**
 * Url сопоставленного товара
 */
class SimilarProductUrlFilter extends MembershipFilter
{
    protected string $name = 'centerCluster__entryProduct__url';

}