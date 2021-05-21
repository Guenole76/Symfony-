<?php
namespace App\Entity;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getCardName(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }
    public function getExtension(): ?string
    {
        return $this->extension;
    }
    public function setExtension(string $extension): self
    {
        $this->extension = $extension;
        return $this;
    }
    public function getRarety(): ?string
    {
        return $this->getRarety;
    }
    public function setrarety(string $rarety): self
    {
        $this->rarety = $rarety;
        return $this;
    }
}