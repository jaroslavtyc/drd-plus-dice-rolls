<?php
namespace Drd\DiceRoll\Templates;

use Drd\DiceRoll\DiceRoll;
use Drd\DiceRoll\Roll;
use Drd\DiceRoll\RollOn;
use Granam\Strict\Integer\StrictInteger;

class MalusRollOn2 extends RollOn
{
    /**
     * @var Roll
     */
    private $roll;

    public function __construct(Dice1d6 $dice1d6, NoRollOn $noRollOn, OneMalusRollOn3Minus $oneMalusRollOn3Minus)
    {
        $this->roll = new Roll(
            $dice1d6,
            new StrictInteger(1),
            $noRollOn,
            $oneMalusRollOn3Minus
        );
    }

    /**
     * @param int $rolledValue
     *
     * @return bool
     */
    public function shouldRepeatRoll($rolledValue)
    {
        return intval($rolledValue) === 2;
    }

    /**
     * @return Roll
     */
    public function getRoll()
    {
        return $this->roll;
    }

    /**
     * Transforms rolled value into its final value
     *
     * @param DiceRoll $diceRoll
     * @return int
     */
    protected function evaluateDiceRoll(DiceRoll $diceRoll)
    {
        switch ($diceRoll->getRolledValue()->getValue()) {
            case 1 :
            case 2 :
            case 3 :
                return -1;
            case 4 :
            case 5 :
            case 6 :
                return 0;
            default :
                throw new \LogicException('Unexpected rolled value. Expected 1 - 6, got ' . $diceRoll->getRolledValue()->getValue());
        }
    }

}
