<?php

namespace App\Domain\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_cidadao')]
#[ORM\HasLifecycleCallbacks]
class Cidadao 
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 11 , nullable: false , unique: true)]
    private $nis;
    
    public function __construct($name)
    {   if (empty($name)) {
            throw new \InvalidArgumentException('Nome não pode ser nulo');
        }
        $this->name = $name;
    }

    
    #[ORM\PrePersist]
    public function prePersist()
    {
        $this->nis = $this->generateUniqueNis();
    }

    public function getId()
    {
        return $this->id;
    }

   
    public function getNome()
    {
        return $this->name; 
    }

    public function getNis()
    {
        return $this->nis;
    }

    public function generateUniqueNis(): string
    {
        $nisCode = str_pad(mt_rand(1, 99999999999), 11, '0', STR_PAD_LEFT);
        return $nisCode;
    }

    public function setNome($name)
    {
        $this->name = $name;
    }
}

