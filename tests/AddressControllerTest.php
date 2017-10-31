<?php

use App\User;
use App\Address;

class AddressControllerTest extends TestCase {

    /**
     * Testing address controller.
     *
     * @return void
     */
    public function testAddressController()
    {
        Session::start();

        $form_data_ok = array(
            'City' => 'testcity',
            'Street' => 'teststreet',
            '_token' => csrf_token()
        );

        $form_data_wrong = array(
            'Name' => '@#$%12345',
            'Surname' => '68678^&*%',
            'Age' => 'adsw',
            '_token' => csrf_token()
        );

        // checking required resources
        $user = User::all();
        $this->assertEquals(isset($user[0]),true);

        $address = Address::where('id_user','=',$user[0]->id)->get();
        $this->assertEquals(isset($address[0]),true);

        $form_data_ok['id_user'] = $user[0]->id;

        // action index
        $this->call('GET', 'address/index/'.$user[0]->id);
        $this->assertResponseOk();

        // action create
        $this->call('GET', 'address/create/'.$user[0]->id);
        $this->assertResponseOk();

        // action store
        $this->call('POST', 'address', $form_data_ok);
        $this->assertResponseStatus(302);           // -> redirect
        $this->call('POST', 'address', $form_data_wrong);
        $this->assertResponseOk();

        // action edit
        $this->call('GET', 'address/'.$address[0]->id);
        $this->assertResponseOk();
        $this->call('GET', 'address/'.$address[0]->id.'/edit');
        $this->assertResponseOk();

        // action update
        $this->call('POST', 'address/'.$address[0]->id, $form_data_ok);
        $this->assertResponseStatus(302);               // -> redirect
        $this->call('POST', 'address/'.$address[0]->id, $form_data_wrong);
        $this->assertResponseOk();

        // action destroy
        $this->call('GET', 'address/'.$address[0]->id.'/delete');
        $this->assertResponseStatus(302);               // -> redirect

    }
}
