<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = factory('App\Project')->create();

        $this->assertEquals(url('/projects/' . $project->id), route('projects.show', $project->id));
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User', $project->user);
    }
}
