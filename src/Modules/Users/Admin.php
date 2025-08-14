<?php
namespace MiniStore\Modules\Users;

final class Admin extends User
{
    private array $permissions;

    public function __construct(string $id, string $name, string $email, array $permissions)
    {
        parent::__construct($id, $name, $email);
        $this->permissions = $permissions;
    }

    public function getRole(): string { return 'admin'; }
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions);
    }
}