<?php

namespace Models;

class Article{
    private int $id;
    private string $title;
    private string $chapo;
    private string $content;
    private ?\DateTime $dateCreation;
    private ?\DateTime $dateUpdate;
    private ?\DateTime $dateDelete;



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
     * Get the value of title
     */ 
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of chapo
     */ 
    public function getChapo():string
    {
        return $this->chapo;
    }

    /**
     * Set the value of chapo
     *
     * @return  self
     */ 
    public function setChapo(string $chapo): self
    {
        $this->chapo = $chapo;

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
    public function setDateUpdate(?\DateTime $dateUpdate): self
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
    public function setDateDelete(?\DateTime $dateDelete): self
    {
        $this->dateDelete = $dateDelete;

        return $this;
    }

    /**
     * Get the value of dateCreation
     */ 
    public function getDateCreation()
    {
        if(empty($this->dateCreation)){
            $this->dateCreation = new \DateTime();
        }

        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @return  self
     */ 
    public function setDateCreation(?\DateTime $dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }
}