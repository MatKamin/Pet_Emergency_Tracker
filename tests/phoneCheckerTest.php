<?php


use Gruppe\Petlocator\phoneChecker;
use PHPUnit\Framework\TestCase;

class phoneCheckerTest extends TestCase
{
    public function testCheckPhoneCorrect()
    {
        $this->assertTrue(
            phoneChecker::checkNumber("+43ha678")
        );
        $this->assertTrue(
            phoneChecker::checkNumber("+43699123")
        );
        $this->assertTrue(
            phoneChecker::checkNumber("+431122333")
        );
    }
    public function testCheckPhoneNotCorrect()
    {
        $this->assertFalse(
            phoneChecker::checkNumber("4369912345678")
        );
        $this->assertFalse(
            phoneChecker::checkNumber("thiswillfail")
        );
    }
}
