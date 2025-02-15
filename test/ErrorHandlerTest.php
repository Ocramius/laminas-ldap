<?php

namespace LaminasTest\Ldap;

use Laminas\Ldap\ErrorHandler;
use PHPUnit\Framework\TestCase;

/**
 * @group      Laminas_Ldap
 */
class ErrorHandlerTest extends TestCase
{
    protected $dummyErrorHandler;

    protected function setUp(): void
    {
        $this->dummyErrorHandler = function ($errno, $error) {
        };
    }
    public function testErrorHandlerSettingWorks()
    {
        $errorHandler = new ErrorHandler();

        $returnValue1 = set_error_handler($this->dummyErrorHandler);
        $this->assertIsObject($returnValue1);
        $this->assertInstanceOf(\PHPUnit\Util\ErrorHandler::class, $returnValue1);
        $errorHandler->startErrorHandling();
        $returnValue2 = set_error_handler($this->dummyErrorHandler);
        $this->assertIsObject($returnValue2);
        $this->assertInstanceOf(\Closure::class, $returnValue2);

        restore_error_handler();
        restore_error_handler();
    }

    public function testErrorHandlerRemovalWorks()
    {
        $errorHandler = new ErrorHandler();

        $returnValue1 = set_error_handler($this->dummyErrorHandler);
        $this->assertIsObject($returnValue1);
        $this->assertInstanceOf(\PHPUnit\Util\ErrorHandler::class, $returnValue1);
        $errorHandler->stopErrorHandling();
        $returnValue2 = set_error_handler($this->dummyErrorHandler);
        $this->assertIsObject($returnValue2);
        $this->assertInstanceOf(\PHPUnit\Util\ErrorHandler::class, $returnValue2);

        restore_error_handler();
    }
}
