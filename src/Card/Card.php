<?php

namespace App\Card;

//class for creating cards
class Card
{
    public const
        SUITS = ['H', 'D', 'C', 'S'],
        VALUES = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];
    protected $type;
    protected $value;

    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value . $this->type;
    }

    public function getValueOfCard(): int
    {
        $value = is_numeric($this->value) ? $this->value : 10;
        if (strtolower($this->value) === 'ace') {
            $value = 11;
        }
        return $value;
    }

    public function getTypeOfCard(): string
    {
        return $this->value;
    }

    public static function shuffleDeck(): array
    {
        foreach (self::SUITS as $type) {
            foreach (self::VALUES as $value) {
                $deck[] = new static($type, $value);
            }
        }
        shuffle($deck);

        return $deck;
    }

    public static function getTopCardFromDeck(): self
    {
        return array_shift($_SESSION['deck']);
    }
}
