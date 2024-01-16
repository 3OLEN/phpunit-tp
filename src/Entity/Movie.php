<?php

declare(strict_types=1);

namespace TroisOlen\PhpunitTp\Entity;

class Movie
{
    private ?int $id;

    private ?string $name;

    private ?int $year;

    private ?string $director;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Movie
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Movie
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): Movie
    {
        $this->year = $year;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): Movie
    {
        $this->director = $director;

        return $this;
    }
}
