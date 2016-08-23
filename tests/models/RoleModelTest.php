<?php

use App\Group;
use App\Role;
use App\User;

class RoleModelTest extends TestCase
{
    /**
     * @test
     */
    public function relationship_users()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();

        $role->users()->attach($user);

        $expected = true;
        $actual = $role->users()->get()->contains($user);

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function relationship_groups()
    {
        $group = factory(Group::class)->create();
        $role = factory(Role::class)->create();

        $role->groups()->attach($group);

        $expected = true;
        $actual = $role->groups()->get()->contains($group);

        $this->assertEquals($expected, $actual);
    }
}
