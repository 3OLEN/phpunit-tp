<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Entity;

class Quote
{
    private ?int $id;

    private ?string $value;

    private ?Movie $movie;

    private ?string $character = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Quote
    {
        $this->id = $id;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): Quote
    {
        $this->value = $value;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): Quote
    {
        $this->movie = $movie;

        return $this;
    }

    public function getCharacter(): ?string
    {
        return $this->character;
    }

    public function setCharacter(?string $character): Quote
    {
        $this->character = $character;

        return $this;
    }
}
