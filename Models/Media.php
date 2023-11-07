<?php

namespace Models;

class Media{
    private int $id;
    private string $description;
    private string $pathMedia;
    private \DateTime $dateCreation;
    private \DateTime $dateUpdate;
    private \DateTime $dateDelete;


    /**
     * Get the value of id
     */ 
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of pathMedia
     */ 
    public function getPathMedia(): string
    {
        return $this->pathMedia;
    }

    /**
     * Set the value of pathMedia
     *
     * @return  self
     */ 
    public function setPathMedia($pathMedia): self
    {
        $this->pathMedia = $pathMedia;

        return $this;
    }

    /**
     * Get the value of dateCreation
     */ 
    public function getDateCreation(): \DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */ 
    public function setDateCreation($dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get the value of dateUpdate
     */ 
    public function getDateUpdate(): \DateTime
    {
        return $this->dateUpdate;
    }

    /**
     * Set the value of dateUpdate
     *
     * @return  self
     */ 
    public function setDateUpdate($dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }

    /**
     * Get the value of dateDelete
     */ 
    public function getDateDelete(): \DateTime
    {
        return $this->dateDelete;
    }

    /**
     * Set the value of dateDelete
     *
     * @return  self
     */ 
    public function setDateDelete($dateDelete): self
    {
        $this->dateDelete = $dateDelete;

        return $this;
    }
}