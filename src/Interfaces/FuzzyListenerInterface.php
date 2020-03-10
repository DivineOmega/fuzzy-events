<?php

namespace DivineOmega\FuzzyEvents\Interfaces;

interface FuzzyListenerInterface
{
    public function handle(string $query);
}