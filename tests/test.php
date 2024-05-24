<?php

use PHPUnit\Framework\TestCase;

include('../html/public/php/functions.php');

class ValidatorTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testCheckDniValid()
    {
        $this->assertTrue($this->validator->check_dni("12345678Z"));
        $this->assertTrue($this->validator->check_dni("87654321A"));
    }

    public function testCheckDniInvalid()
    {
        $this->assertFalse($this->validator->check_dni("12345678A")); // Letra no valida
        $this->assertFalse($this->validator->check_dni("A2345678Z")); // Formato no valido
        $this->assertFalse($this->validator->check_dni("1234567Z"));  // Muy corta
        $this->assertFalse($this->validator->check_dni("123456789Z")); // Muy larga
        $this->assertFalse($this->validator->check_dni("")); // Vacio
    }

    public function testValidatePasswordValid()
    {
        $this->assertTrue($this->validator->validatePassword("Valid123!"));
        $this->assertTrue($this->validator->validatePassword("Anoth3r$"));
    }

    public function testValidatePasswordInvalid()
    {
        $this->assertFalse($this->validator->validatePassword("short1A!")); // Muy corta
        $this->assertFalse($this->validator->validatePassword("alllowercase1!")); // Sin mayuscula
        $this->assertFalse($this->validator->validatePassword("ALLUPPERCASE1!")); // Sin minuscula
        $this->assertFalse($this->validator->validatePassword("NoNumber!")); // Sin numero
        $this->assertFalse($this->validator->validatePassword("NoSpecial1")); // Sin caracter especial
        $this->assertFalse($this->validator->validatePassword("")); // Vacia
    }
}
