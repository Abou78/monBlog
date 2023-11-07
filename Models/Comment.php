<?php

namespace Models;

class Comment{
    private int $id;
    private string $comment;
    private bool $isValid;
    private string $content;
    private \DateTime $dateCreation;
    private \DateTime $dateDelete;


    /**
     * Get the value of id
     */ 
    public function getId(): int
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
     * Get the value of comment
     */ 
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of isValid
     */ 
    public function getIsValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Set the value of isValid
     *
     * @return  self
     */ 
    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get the value of content
     */ 
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent(string $content): self
    {
        $this->content = $content;

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
    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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
    public function setDateDelete(string $dateDelete): self
    {
        $this->dateDelete = $dateDelete;

        return $this;
    }
}