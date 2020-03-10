<?php

use DivineOmega\FuzzyEvents\Exceptions\ConfidenceTooLowException;
use DivineOmega\FuzzyEvents\FuzzyDispatcher;
use DivineOmega\FuzzyEvents\TestClasses\Greeting;
use PHPUnit\Framework\TestCase;

class FuzzyEventsTest extends TestCase
{
    private function getDispatcher(): FuzzyDispatcher
    {
        $listeners = [
            Greeting::class => [
                'Hello',
                'Hi',
                'Hey',
                'Greetings',
                'Howdy',
                'Hello there',
                'Hi there',
            ],
        ];

        $confidenceThreshold = 75;

        return new FuzzyDispatcher($listeners, $confidenceThreshold);
    }

    public function testEventFiring()
    {
        $response = $this->getDispatcher()->fire('Greetingz!');

        $this->assertEquals('Hello there!', $response);
    }

    public function testLowConfidenceEventFiring()
    {
        $this->expectException(ConfidenceTooLowException::class);

        $response = $this->getDispatcher()->fire('Goodbye!');
    }

    public function testGetListener()
    {
        $listener = $this->getDispatcher()->getListener('Why hello there');

        $this->assertEquals(Greeting::class, get_class($listener));
    }

    public function testGetListenerClassName()
    {
        $className = $this->getDispatcher()->getListenerClassName('Hello!!');

        $this->assertEquals(Greeting::class, $className);
    }

    public function testGetConfidences()
    {
        $confidences = $className = $this->getDispatcher()->getConfidences('Hi!');

        $this->assertEquals([
            Greeting::class => 80
        ], $confidences);
    }
}