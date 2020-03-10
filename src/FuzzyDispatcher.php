<?php

namespace DivineOmega\FuzzyEvents;

use DivineOmega\FuzzyEvents\Exceptions\ConfidenceTooLowException;
use DivineOmega\FuzzyEvents\Interfaces\FuzzyListener;

class FuzzyDispatcher
{
    /**
     * @var array
     */
    private $listeners;

    /**
     * @var float
     */
    private $confidenceThreshold;

    public function __construct(array $listeners, float $confidenceThreshold)
    {
        $this->listeners = $listeners;
        $this->confidenceThreshold = $confidenceThreshold;
    }

    public function fire(string $query)
    {
        $listener = $this->getListener($query);

        return $listener->handle($query);
    }

    public function getListener(string $query): ?FuzzyListener
    {
        $className = $this->getListenerClassName($query);

        return new $className;
    }

    public function getListenerClassName(string $query): ?string
    {
        $confidences = $this->getConfidences($query);

        rsort($confidences);

        $listenerClassNames = array_keys($confidences);

        $highestConfidence = $confidences[0];

        if ($highestConfidence < $this->confidenceThreshold) {
            throw new ConfidenceTooLowException($this->confidenceThreshold, $highestConfidence);
        }

        return $listenerClassNames[0];
    }

    public function getConfidences(string $query): array
    {

    }
}