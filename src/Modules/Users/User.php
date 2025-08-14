<?php
namespace MiniStore\Modules\Users;

abstract class User
{
    protected string $id;
    protected string $name;
    protected string $email;

    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    abstract public function getRole(): string;

    // Getters
    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
}