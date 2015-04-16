<?php
namespace Drd\DiceRoll\Templates;

use Drd\DiceRoll\DiceRoll;
use Drd\DiceRoll\Roll;
use Drd\DiceRoll\RollOn;
use Granam\Strict\Integer\StrictInteger;

class OneBonusRollOn4Plus extends RollOn
{
    /**
     * @var Roll
     */
    private $roll;

    public function __construct(Dice1d6 $dice1d6)
    {
        $this->roll = new Roll(
            $dice1d6,
            new StrictInteger(1), // rol just once
            new NoRollOn(),
            $this // in case of high roll (4 - 6) the bonus roll continues
        );
    }

    /**
     * @param int $rolledValue
     *
     * @return bool
     */
    public function shouldRepeatRoll($rolledValue)
    {
        return intval($rolledValue) >= 4;
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
                return 0;
            case 4 :
            case 5 :
            case 6 :
                return 1;
            default :
                throw new \LogicException('Unexpected rolled value. Expected 1 - 6, got ' . $diceRoll->getRolledValue()->getValue());
        }
    }

}
