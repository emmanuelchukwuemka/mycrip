<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordStrength implements ValidationRule
{
    protected $minLength = 8;
    protected $requireUppercase = true;
    protected $requireLowercase = true;
    protected $requireNumbers = true;
    protected $requireSpecial = true;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) < $this->minLength) {
            $fail("The {$attribute} must be at least {$this->minLength} characters.");
            return;
        }

        if ($this->requireUppercase && !preg_match('/[A-Z]/', $value)) {
            $fail("The {$attribute} must contain at least one uppercase letter.");
            return;
        }

        if ($this->requireLowercase && !preg_match('/[a-z]/', $value)) {
            $fail("The {$attribute} must contain at least one lowercase letter.");
            return;
        }

        if ($this->requireNumbers && !preg_match('/[0-9]/', $value)) {
            $fail("The {$attribute} must contain at least one number.");
            return;
        }

        if ($this->requireSpecial && !preg_match('/[!@#$%^&*()\-_=+{}|\[\]:;"\'<>?,.\/]/', $value)) {
            $fail("The {$attribute} must contain at least one special character.");
            return;
        }

        // Check for common weak passwords
        $weakPasswords = [
            'password', '12345678', 'qwertyui', 'letmein123', 'welcome123',
            'admin123', 'user1234', 'password123', '123456789', 'abcdefg123'
        ];

        if (in_array(strtolower($value), $weakPasswords)) {
            $fail("The {$attribute} is too common and weak.");
            return;
        }
    }

    public function minLength(int $length): self
    {
        $this->minLength = $length;
        return $this;
    }

    public function requireUppercase(bool $require = true): self
    {
        $this->requireUppercase = $require;
        return $this;
    }

    public function requireLowercase(bool $require = true): self
    {
        $this->requireLowercase = $require;
        return $this;
    }

    public function requireNumbers(bool $require = true): self
    {
        $this->requireNumbers = $require;
        return $this;
    }

    public function requireSpecial(bool $require = true): self
    {
        $this->requireSpecial = $require;
        return $this;
    }
}
