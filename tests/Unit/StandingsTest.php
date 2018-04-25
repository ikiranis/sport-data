<?php

namespace Tests\Unit;

use App\src\Standings;
use ReflectionClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StandingsTest extends TestCase
{

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    public function invokeMethod(&$object, $methodName, array $parameters)
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Test who is the winner
     *
     * @throws \ReflectionException
     */
    public function testWhoIsTheWinner()
    {
        $standings = new Standings();

        $winner = $this->invokeMethod($standings, 'whoIsTheWinner', array('3', '2'));

        $expectedWinner = '1';

        $this->assertEquals($expectedWinner, $winner);
    }
}
