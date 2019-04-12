<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];

        // $this->post(route('projects.store', $attributes))->assertRedirect(route('projects/index'));
        $this->post(route('projects.store', $attributes))->assertRedirect(route('projects.index'));


        $this->assertDatabaseHas('projects', $attributes);

        $this->get(route('projects.index'))->assertSee($attributes['title']);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_a_project()
    {
        $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get(route('projects.show', $project))
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
}
