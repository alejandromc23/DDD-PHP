<?php

namespace Chaplin\Quote\Domain\Entity;

class Quote
{
    private int $id;

    private string $quote;

    private string $historian;

    private string $year;

    public function __construct($id, $quote, $historian, $year)
    {
        $this->id = $id;
        $this->quote = $quote;
        $this->historian = $historian;
        $this->year = $year;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function quote(): string
    {
        return $this->quote;
    }

    public function setQuote(string $quote): self
    {
        $this->quote = $quote;

        return $this;
    }

    public function historian(): string
    {
        return $this->historian;
    }

    public function setHistorian(string $historian): self
    {
        $this->historian = $historian;

        return $this;
    }

    public function year(): string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }
}
