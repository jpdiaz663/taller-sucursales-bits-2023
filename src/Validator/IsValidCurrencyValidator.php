<?php

namespace App\Validator;

use App\Entity\Currency;
use App\Entity\User;
use App\Repository\CurrencyRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsValidCurrencyValidator extends ConstraintValidator
{

    public function __construct(private readonly CurrencyRepository $currencyRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint IsValidCurrency */

        if (null === $value || '' === $value) {
            return;
        }

       $currency = $this->currencyRepository->findOneBy(['name' => $value]);
        if (!$currency instanceof Currency) {
            throw new \InvalidArgumentException('@isValidCurrency constraint must be put on a property containing a User object');
        }


        if ($value !== $currency->getName()) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
