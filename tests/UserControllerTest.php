<?php

use App\User;

class UserControllerTest extends TestCase {

    /**
     * Testing user controller.
     *
     * @return void
     */
    public function testUserController()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $randchar = $characters[rand(0, strlen($characters))];

        Session::start();

        $form_data_ok = array(
            'Name' => 'testname'.$randchar,
            '_token' => csrf_token()
        );

        $form_data_wrong = array(
            'Name' => '@#$%12345',
            '_token' => csrf_token()
        );

        // checking required resources
        $user = User::all();
        $this->assertEquals(isset($user[0]),true);

        // action index
        $this->call('GET', '/');
        $this->assertResponseOk();
        $this->call('GET', 'user');
        $this->assertResponseOk();
        $this->call('GET', 'user/index');
        $this->assertResponseOk();

        // action create
        $this->call('GET', 'user/create');
        $this->assertResponseOk();

        // action store
        $this->call('POST', 'user', $form_data_ok);
        $this->assertResponseStatus(302);               // -> redirect
        $this->call('POST', 'user', $form_data_wrong);
        $this->assertResponseOk();

        // action show
        $this->call('GET', 'user/'.$user[0]->id);
        $this->assertResponseStatus(302);               // -> redirect

        // action edit
        $this->call('GET', 'user/'.$user[0]->id.'/edit');
        $this->assertResponseOk();

        // action update
        $this->call('POST', 'user/'.$user[0]->id, $form_data_ok);
        $this->assertResponseStatus(302);               // -> redirect
        $this->call('POST', 'user/'.$user[0]->id, $form_data_wrong);
        $this->assertResponseOk();

        // action destroy
        $this->call('GET', 'user/'.$user[0]->id.'/delete');
        $this->assertResponseStatus(302);               // -> redirect

    }
}
