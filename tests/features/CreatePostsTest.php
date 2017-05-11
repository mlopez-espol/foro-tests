<?php

class CreatePostsTest extends FeatureTestCase
{
    public function test_a_user_create_a_post()
    {
        $title = 'Esta es una pregunta';
        $contenido = 'Este es el contenido';

        $user = $this->defaultUser();

        $this->actingAs($user);

        $this->visit(route('posts.create'))
             ->type($title, 'title')
             ->type($contenido, 'content')
             ->press('Publicar');

        $this->seeInDatabase('posts', [
            'title' => $title,
            'content' => $contenido,
            'pending' => true,
            'user_id' => $user->id
        ]);

        $this->see($title);
    }

    public function test_creating_a_post_requires_authentication()
    {
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }

    public function test_create_post_form_validation()
    {
        $this->actingAs($this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeErrors([
                'title' => 'El campo título es obligatorio',
                'content' => 'El campo contenido es obligatorio'
            ]);
    }
}
