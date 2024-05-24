<?php

use PHPUnit\Framework\TestCase;

include('../public/php/functions.php');

class test extends TestCase
{
    public function testCheckDniValid()
    {
        $function = new Functions();
        $this->assertTrue($function->check_dni("12345678Z"));
        $this->assertTrue($function->check_dni("87654321A"));
    }

    public function testCheckDniInvalid()
    {
        $function = new Functions();
        $this->assertFalse($function->check_dni("12345678A")); // Letra no valida
        $this->assertFalse($function->check_dni("A2345678Z")); // Formato no valido
        $this->assertFalse($function->check_dni("1234567Z"));  // Muy corta
        $this->assertFalse($function->check_dni("123456789Z")); // Muy larga
        $this->assertFalse($function->check_dni("")); // Vacio
    }

    public function testValidatePasswordValid()
    {
        $function = new Functions();
        $this->assertTrue($function->validatePassword("Valid123!"));
        $this->assertTrue($function->validatePassword("Anoth3r$"));
    }

    public function testValidatePasswordInvalid()
    {
        $function = new Functions();
        $this->assertFalse($function->validatePassword("short1A!")); // Muy corta
        $this->assertFalse($function->validatePassword("alllowercase1!")); // Sin mayuscula
        $this->assertFalse($function->validatePassword("ALLUPPERCASE1!")); // Sin minuscula
        $this->assertFalse($function->validatePassword("NoNumber!")); // Sin numero
        $this->assertFalse($function->validatePassword("NoSpecial1")); // Sin caracter especial
        $this->assertFalse($function->validatePassword("")); // Vacia
    }
}
