<?php

namespace App\Counter\Command;

class CompositeCounterCommand implements CounterCommandInterface
{
    /**
     * @param CounterCommandInterface[] $commands
     */
    public function __construct(private array $commands)
    {
    }

    public function counter(): void
    {
        collect($this->commands)
            ->each(
                fn(CounterCommandInterface $command) => $command->counter()
            );
    }
}
