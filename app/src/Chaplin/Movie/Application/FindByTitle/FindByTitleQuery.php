<?php


namespace Chaplin\Movie\Application\FindByTitle;


use Chaplin\Core\CommandBus\QueryHandlerInterface;

class FindByTitleQuery
{
    public function __construct(
        private string $title
    )
    {
    }

    public function title(): string
    {
        return $this->title;
    }
}