<?php

namespace app\models;

class EmployeeModel extends Model
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $phone = '';
    public string $address = '';
    public string $city = '';
    public string $state = '';
    public string $zip = '';
    public string $country = '';
    public string $role = '';

    public function tableName(): string
    {
        return 'employee';
    }

    public function attributes(): array
    {
        return [
            'firstName',
            'lastName',
            'email',
            'password',
            'phone',
            'address',
            'city',
            'state',
            'zip',
            'country',
            'role'
        ];
    }

    public function rules(): array
    {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'phone' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'state' => [self::RULE_REQUIRED],
            'zip' => [self::RULE_REQUIRED],
            'country' => [self::RULE_REQUIRED],
            'role' => [self::RULE_REQUIRED]
        ];
    }

    public function registerEmployee()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return true;
        return $this->save();
    }
}
{

}