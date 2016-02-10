<?php

use Kahlan\Plugin\Stub;
use Distribution\Constraint\HardConstraints;
use Distribution\Contract\HardConstraint;

describe('HardConstraints', function () {
    describe('->isAllowed()', function () {

        given('hardConstraintAllow', function () {
            $constraint = Stub::create(['implements' => [HardConstraint::class]]);

            Stub::on($constraint)
                ->method('isAllowed', function (array $combination) : bool {
                    return true;
                });

            return $constraint;
        });

        given('hardConstraintDisallow', function () {
            $constraint = Stub::create(['implements' => [HardConstraint::class]]);

            Stub::on($constraint)
                ->method('isAllowed', function (array $combination) : bool {
                    return false;
                });

            return $constraint;
        });

        it("Allows when given hard constraint allow", function () {

            $hardConstraints = new HardConstraints(
                $this->hardConstraintAllow
            );

            expect($hardConstraints->isAllowed([]))->toBe(true);

        });

        it("Disallows when given hard constraint disallow", function () {

            $hardConstraints = new HardConstraints(
                $this->hardConstraintDisallow
            );

            expect($hardConstraints->isAllowed([]))->toBe(false);

        });

        it("Disallows when at least one of given hard constraints disallow", function () {

            $hardConstraints = new HardConstraints(
                $this->hardConstraintAllow,
                $this->hardConstraintDisallow
            );

            expect($hardConstraints->isAllowed([]))->toBe(false);

        });

    });
});
