<?php

namespace App\Entity;

use App\Repository\DiscussionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscussionRepository::class)
 */
class Discussion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=message::class, mappedBy="discussion")
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity=user::class, inversedBy="participants")
     */
    private $participants;

    public function __construct()
    {
        $this->message = new ArrayCollection();
        $this->participants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|message[]
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setDiscussion($this);
        }

        return $this;
    }

    public function removeMessage(message $message): self
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getDiscussion() === $this) {
                $message->setDiscussion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(user $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
        }

        return $this;
    }

    public function removeParticipant(user $participant): self
    {
        $this->participants->removeElement($participant);

        return $this;
    }
}
