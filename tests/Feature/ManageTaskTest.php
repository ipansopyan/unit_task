<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Task;

class ManageTaskTest extends TestCase
{
    use RefreshDatabase;
    public function testUserCreateTask()
    {
        $this->visit('/tasks');

        $this->submitForm('Create Task',[
            'name'           => 'ipan sopyan',
            'description'    => 'ini adlah description',
        ]);

        $this->seeInDatabase('tasks',[
            'name'           => 'ipan sopyan',
            'description'    => 'ini adlah description'
        ]);

        $this->seePageIs('/tasks');
        $this->see('ipan sopyan');
        $this->see('ini adlah description');
    }

    public function testUserCanBrowserTasks()
    {
        $tasks = factory(Task::class,3)->create();
        $this->visit('/tasks');

        $this->see($tasks[0]->name);
        $this->see($tasks[1]->name);
        $this->see($tasks[2]->name);

        $this->seeElement('a',[
            'id'     =>  'edit_task'.$tasks[0]->id,
            'href'   =>  url('tasks?action=edit&id='.$tasks[0]->id),
        ]);

        $this->seeElement('a',[
            'id'     =>  'edit_task'.$tasks[1]->id,
            'href'   =>  url('tasks?action=edit&id='.$tasks[1]->id),
        ]);

        $this->seeElement('a',[
            'id'     =>  'edit_task'.$tasks[2]->id,
            'href'   =>  url('tasks?action=edit&id='.$tasks[2]->id),
        ]);

    }

    public function testUserCanEditTask()
    {
        $task = factory(Task::class)->create();

        $this->visit('/tasks');
        $this->click('edit_task'.$task->id);
        $this->seePageIs('/tasks?action=edit&id='.$task->id);

        $this->seeElement('form',[
            'id'        =>  'edit_task'.$task->id,
            'action'    =>  url('/tasks/'.$task->id),
        ]);
        
        $this->submitForm('Update Task',[
            'name'  => 'task hasil update',
            'description'   => 'description hasil update',
        ]);

        $this->seePageIs('tasks');

        $this->seeIndatabase('tasks',[
            'name'  => 'task hasil update',
            'description'   => 'description hasil update',
        ]);




    }

    public function testValidateEntryTask()
    {
        $this->post('tasks',[
            'name'          => '',
            'description'   => '',
        ]);

        $this->assertSessionHasErrors(['name','description']);
    }

    public function testDelteBlog()
    {
        $task =  factory(Task::class)->create();

        $this->visit('tasks');

        $this->press('delete_task'.$task->id);
        $this->seePageIs('/tasks');

        $this->dontSeeInDatabase('tasks',[
             'id'   => $task->id,   
            'name'  =>  $task->name,
            'description'   => $task->description,
        ]);
    }
}
