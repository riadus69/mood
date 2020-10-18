<?php

namespace App\Entity;

use App\Repository\MoodRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=MoodRepository::class)
 * @Vich\Uploadable
 */
class Mood
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="avatar_image", fileNameProperty="avatarname")
     * @Vich\UploadableField(mapping="product_images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $iduser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mooduser;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $avatarname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getMooduser(): ?string
    {
        return $this->mooduser;
    }

    public function setMooduser(string $mooduser): self
    {
        $this->mooduser = $mooduser;

        return $this;
    }

    public function getAvatarname(): ?string
    {
        return $this->avatarname;
    }

    public function setAvatarname(string $avatar): self
    {
        $this->avatarname = $avatar;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $image): Mood
    {
        $this->imageFile instanceof UploadedFile;
        $this->imageFile = $image;

        return $this;
    }
}
