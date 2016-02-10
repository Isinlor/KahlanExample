<?php

namespace Distribution\Contract;

interface HardConstraint
{
    public function isAllowed(array $combination) : bool;
}
