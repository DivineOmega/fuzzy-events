<?php

namespace DivineOmega\FuzzyEvents\TestClasses;

use DivineOmega\FuzzyEvents\Interfaces\FuzzyListenerInterface;

class Greeting implements FuzzyListenerInterface
{

    public function handle(string $query)
    {
        return 'Hello there!';
    }
}