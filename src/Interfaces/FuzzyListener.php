<?php

namespace DivineOmega\FuzzyEvents\Interfaces;

interface FuzzyListener
{
    public function handle(string $query);
}