<?php

namespace Tests\Feature;

use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ContactsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function fields_are_required()
    {
        collect(['name','email','birthday', 'company'])
        ->each(function($field){
            $response = $this->post('/api/contacts',array_merge($this->data(),[$field => '']));
            
            $response->assertSessionHasErrors($field);
            $this->assertCount(0, Contact::all());
        });
    }    
    
    private function data()
    {
        return [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String'
        ];
    }
}
