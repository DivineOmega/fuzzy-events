# Fuzzy Events

[![Build Status](https://travis-ci.com/DivineOmega/fuzzy-events.svg?branch=master)](https://travis-ci.com/DivineOmega/fuzzy-events)

Fuzzy events is a PHP package that allows you to perform actions based on a 
fuzzy string matches.

## Installation

Install using the following Composer command.

```bash
composer require divineomega/fuzzy-events
```

### Usage Example

See the following usage example.

```php
class Greeting implements FuzzyListenerInterface
{

    public function handle(string $query)
    {
        return 'Hello there!';
    }
}
```

```php
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

$dispatcher = new FuzzyDispatcher($listeners, $confidenceThreshold);

$response = $dispatcher->fire('Greetingz!');

// $response = 'Hello there!'

$confidences = $dispatcher->getConfidences('Hi!');

// $confidences = [
//    Greeting::class => 80
// ]
```
