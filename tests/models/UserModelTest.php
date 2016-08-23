<?php

use App\Group;
use App\Role;
use App\User;

class UserModelTest extends TestCase
{
    /**
     * @test
     */
    public function relationship_roles()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();

        $user->roles()->attach($role);

        $expected = true;
        $actual = $user->roles()->get()->contains($role);

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function relationship_groups()
    {
        $group = factory(Group::class)->create();
        $user = factory(User::class)->create();

        $user->groups()->attach($group);

        $expected = true;
        $actual = $user->groups()->get()->contains($group);

        $this->assertEquals($expected, $actual);
    }
}
