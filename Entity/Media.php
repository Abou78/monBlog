<?php

namespace Entity;

class Media
{

    private int $id;

    private string $description;

    private string $pathMedia;

    private \DateTime $dateCreation;

    private \DateTime $dateUpdate;


    public function getId(): string
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getPathMedia(): string
    {
        return $this->pathMedia;
    }


    public function setPathMedia($pathMedia): self
    {
        $this->pathMedia = $pathMedia;

        return $this;
    }


    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }


    public function setDateCreation($dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }


    public function getDateUpdate(): \DateTime
    {
        return $this->dateUpdate;
    }


    public function setDateUpdate($dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }
    
}