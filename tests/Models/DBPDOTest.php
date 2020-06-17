<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Models\DBPDO;
use Helpers\DB;

final class DBPDOTest extends TestCase
{
    /**
     * @test
     */
    public function DBPDO_stub_useConfig_method_returns_a_DB_instance(): void
    {
        $stub = $this->createStub(DBPDO::class);

        $stub->method('useConfig')
            ->will($this->returnValue(new DB()));

        $this->assertSame('Helpers\DB', get_class($stub->useConfig('config_name')));
    }
}
