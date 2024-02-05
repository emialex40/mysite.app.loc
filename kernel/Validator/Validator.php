<?php

namespace App\Kernel\Validator;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    private array $data;

    public function validate(array $data, array $rules): bool
    {
        $this->errors = [];
        $this->data = $data;


        foreach ($rules as $key => $rule) {
            $rules      = $rule;

            foreach ($rules as $rul) {
                $rul = explode(':', $rul);

                $ruleName = $rul[0];
                $ruleValue = $rul[1] ?? null;

                $error = $this->validateRule($data, $key, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    private function validateRule(array $data, string $key, string $ruleName, string $ruleValue = null): string|false
    {
        switch ($ruleName) {
            case 'required':
                if ($data[$key] == '') {
                    return "The field $key is required.";
                }
                break;
            case 'min':
                if (strlen($data[$key]) < $ruleValue) {
                    return "The field $key must be at least $ruleValue characters long.";
                }
                break;
            case 'max':
                if (strlen($data[$key]) > $ruleValue) {
                    return "The field $key may not be greater than $ruleValue characters.";
                }
                break;
            case 'email':
                if (! filter_var($ruleValue, FILTER_VALIDATE_EMAIL)) {
                    return "Value $ruleValue must be valid email address.";
                }
                break;
        }

        return false;
    }
}
