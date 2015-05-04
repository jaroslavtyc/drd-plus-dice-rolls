<?php
namespace Drd\DiceRoll\Templates\Evaluators;

use Drd\DiceRoll\DiceRoll;
use Granam\Strict\Integer\StrictInteger;

class FourOrMoreAsPlusOneEvaluatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function can_create_instance()
    {
        $instance = new FourOrMoreAsOneEvaluator();
        $this->assertNotNull($instance);
    }

    /**
     * @test
     * @depends can_create_instance
     */
    public function greater_than_three_value_is_considered_as_plus_one_zero_otherwise()
    {
        $evaluator = new FourOrMoreAsOneEvaluator(\Mockery::mock(DiceRoll::class));
        /** @var DiceRoll|\Mockery\MockInterface $diceRoll */
        $diceRoll = \Mockery::mock(DiceRoll::class);
        $diceRoll->shouldReceive('getRolledNumber')
            ->once()
            ->andReturn($rolledNumber = \Mockery::mock(StrictInteger::class));
        $rolledNumber->shouldReceive('getValue')
            ->atLeast()->once()
            ->andReturnValues($values = [-4, -3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]);
        foreach ($values as $value) {
            $evaluated = $evaluator->evaluateDiceRoll($diceRoll);
            if ($value > 3) {
                $this->assertSame(1, $evaluated->getValue(), "Value of $value should be 1, but was evaluated as {$evaluated->getValue()}");
            } else {
                $this->assertSame(0, $evaluated->getValue());
            }
        }
    }
}
