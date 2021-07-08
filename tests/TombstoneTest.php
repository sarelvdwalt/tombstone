<?php

use SarelvdWalt\Tombstone\Tombstone;
use PHPUnit\Framework\TestCase;
use SarelvdWalt\Tombstone\TombstoneBase;

class TombstoneTest extends TestCase
{
    public function testInstantiateThroughSingleton()
    {
        $ts = Tombstone::getInstance();

        $this->assertInstanceOf(TombstoneBase::class, $ts);
    }

    public function testOnlyGetOneInstanceAfterMultipeSingletonCalls()
    {
        $ts = Tombstone::getInstance();
        $ts2 = Tombstone::getInstance();

        $this->assertSame($ts, $ts2);
    }
}
