<?php

namespace Chaplin\Movie\Application\FindByTitle;

class FindByTitleQuery
{
    public function __construct(
        private string $title
    ) {
    }

    public function title(): string
    {
        return $this->title;
    }
}
