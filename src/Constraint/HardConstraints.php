<?php

namespace Distribution\Constraint;

use Distribution\Contract\HardConstraint;

class HardConstraints implements HardConstraint
{

    protected $constraints = [];

    public function __construct(HardConstraint ...$constraints)
    {
        $this->constraints = $constraints;
    }

    public function isAllowed(array $combination) : bool
    {

        foreach ($this->constraints as $constraint) {
            if (!$constraint->isAllowed($combination)) {
                return false;
            }
        }

        return true;
    }

}
