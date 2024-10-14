<?php

namespace App\Entity;

use App\Repository\UserCompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Choice;

#[ORM\Entity(repositoryClass: UserCompanyRepository::class)]
class UserCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    #[Choice(Choices: ['admin', 'manager', 'consultant'], message: 'Choose a valid role.')]
    private ?string $role = null;

    // Relations avec User et Company
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userCompanies')]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'userCompanies')]
    private ?Company $company = null;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->company = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
}
