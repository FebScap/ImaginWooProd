<?php

namespace App\Entity;

use App\Repository\ActuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use function PHPUnit\Framework\isNull;

#[ORM\Entity(repositoryClass: ActuRepository::class)]
class Actu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $enddate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getDateString() : string
    {
        if ($this->enddate == null) {
            return "Le " . $this->date->format('d') . " " . $this->date->format('M') . " " . $this->date->format('Y');
        } else if ($this->date->format('m') != $this->enddate->format('m')) {
            return "Du " . $this->date->format('d') . " " . $this->date->format('M') . " "
                . " au " . $this->enddate->format('d') . " " . $this->enddate->format('M') . " " . $this->enddate->format('Y');
        } else {
            return "Du " . $this->date->format('d') . " "
                . " au " . $this->enddate->format('d') . " " . $this->enddate->format('M') . " " . $this->enddate->format('Y');
        }
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function setEndDate(?\DateTimeInterface $date): static
    {
        $this->enddate = $date;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): static
    {
        $this->file = $file;

        return $this;
    }
}
