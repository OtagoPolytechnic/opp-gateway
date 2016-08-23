<?php

use App\Group;
use App\PaperInstance;
use App\Role;
use App\User;

class GroupModelTest extends TestCase
{
    /**
     * @test
     */
    public function hasRole_groupHasRole()
    {
        $group = factory(Group::class)->create();
        $role = factory(Role::class)->create();

        $group->roles()->attach($role);

        $expected = true;
        $actual = $group->hasRole($role);

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function hasRole_groupDoesntHaveRole()
    {
        $group = factory(Group::class)->create();
        $role = factory(Role::class)->create();

        $expected = false;
        $actual = $group->hasRole($role);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_paperInstance()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $group = factory(Group::class)->create(['paper_instance_id' => $paperInstance->id]);

        $expected = $paperInstance->id;
        $actual = $group->paperInstance->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_roles()
    {
        $group = factory(Group::class)->create();
        $role = factory(Role::class)->create();

        $group->roles()->attach($role);

        $expected = true;
        $actual = $group->hasRole($role);

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function relationship_users()
    {
        $group = factory(Group::class)->create();
        $user = factory(User::class)->create();

        $group->users()->attach($user);

        $expected = true;
        $actual = $group->users->contains($user);

        $this->assertEquals($expected, $actual);
    }
}
