<?php
namespace Drd\DiceRoll;

use Granam\Integer\IntegerInterface;
use Granam\Strict\Object\StrictObject;

class DiceRoll extends StrictObject implements IntegerInterface
{
    /**
     * @var Dice
     */
    private $dice;
    /**
     * @var IntegerInterface
     */
    private $rolledNumber;
    /**
     * @var IntegerInterface
     */
    private $sequenceNumber;
    /**
     * @var DiceRollEvaluator
     */
    private $diceRollEvaluator;

    /**
     * @param Dice $dice
     * @param IntegerInterface $rolledNumber
     * @param IntegerInterface $sequenceNumber
     * @param DiceRollEvaluator $diceRollEvaluator
     */
    public function __construct(
        Dice $dice,
        IntegerInterface $rolledNumber,
        IntegerInterface $sequenceNumber,
        DiceRollEvaluator $diceRollEvaluator
    )
    {
        $this->dice = $dice;
        $this->rolledNumber = $rolledNumber;
        $this->sequenceNumber = $sequenceNumber;
        $this->diceRollEvaluator = $diceRollEvaluator;
    }

    /**
     * @return Dice
     */
    public function getDice()
    {
        return $this->dice;
    }

    /**
     * @return IntegerInterface
     */
    public function getRolledNumber()
    {
        return $this->rolledNumber;
    }

    /**
     * @return IntegerInterface
     */
    public function getSequenceNumber()
    {
        return $this->sequenceNumber;
    }

    /**
     * @return DiceRollEvaluator
     */
    public function getDiceRollEvaluator()
    {
        return $this->diceRollEvaluator;
    }

    /**
     * @return int
     */
    public function getValue()
    {
        return $this->diceRollEvaluator->evaluateDiceRoll($this)->getValue();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }
}
