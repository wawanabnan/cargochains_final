<?php
declare(strict_types=1);

namespace App\Policy;

use Authorization\IdentityInterface;
use CakeDC\Users\Model\Entity\User;

class UserPolicy
{
    public function canView(IdentityInterface $user, User $resource): bool { return $this->isAdmin($user); }
    public function canAdd(IdentityInterface $user, User $resource): bool  { return $this->isAdmin($user); }
    public function canEdit(IdentityInterface $user, User $resource): bool { return $this->isAdmin($user); }

    private function isAdmin(IdentityInterface $user): bool
    {
        // pakai is_superuser dari CakeDC, atau cek groups
        if ($user->get('is_superuser')) return true;
        $groups = (array)$user->get('groups');
        return in_array('admin', $groups, true);
    }
}
