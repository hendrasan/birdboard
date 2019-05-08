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

        $this->actingAs(factory('App\User')->create());

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
    public function guests_cannot_create_projects()
    {
        // $this->withoutExceptionHandling();

        $attributes = factory('App\Project')->raw();

        $this->post(route('projects.store'), $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_projects()
    {
        $this->get(route('projects.index'))->assertRedirect('login');
    }

    /** @test */
    public function guests_may_not_view_a_project()
    {
        $project = factory('App\Project')->create();

        $this->get(route('projects.show', $project))->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_view_a_project()
    {
        $this->be(factory('App\User')->create());

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create(['user_id' => auth()->id()]);

        $this->get(route('projects.show', $project))
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_user_cannot_view_other_users_projects()
    {
        $this->be(factory('App\User')->create());

        // $this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        $this->get(route('projects.show', $project))->assertStatus(403);
    }

    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['description' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }

}
