<?php

namespace Entity;

class Article
{

    private int $id;

    private ?string $title = null;

    private ?string $chapo = null;

    private ?string $content = null;

    private ?\DateTime $dateCreation = null;

    private ?\DateTime $dateUpdate = null;
    
    private ?int $userId = null;


    public function getId(): int
    {
        return $this->id;
    }


    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }


    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getChapo(): ?string
    {
        return $this->chapo;
    }


    public function setChapo(?string $chapo): self
    {
        $this->chapo = $chapo;

        return $this;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }


    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

 
    public function getDateUpdate(): ?\DateTime
    {
        return $this->dateUpdate;
    }


    public function setDateUpdate(?\DateTime $dateUpdate): self
    {
        $this->dateUpdate = $dateUpdate;

        return $this;
    }


    public function getDateCreation()
    {
        if(empty($this->dateCreation)){
            $this->dateCreation = new \DateTime();
        }

        return $this->dateCreation;
    }


    public function setDateCreation(?\DateTime $dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }


    public function getUserId(): ?int
    {
        return $this->userId;
    }


    public function setUserId($userId): self
    {
        $this->userId = $userId;

        return $this;
    }

}