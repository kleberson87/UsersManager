<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Validators\AddressValidator;
use App\Address;

class AddressController extends Controller {

    private $valErrors = array();

    /** Display a list of addresses.
     * @param int $id_user
     * @return \Illuminate\View\View
     */
    public function index($id_user)
    {
        $addresses = Address::where('id_user','=',$id_user)
            ->get();

        return view('address\index',
            [ 'page_title' => 'List of addresses',
                'addresses' => $addresses,
                'id_user' => $id_user]);
    }

    /** Show the form for creating a new address.
     * @param int $id_user
     * @return \Illuminate\View\View
     */
    public function create($id_user)
    {
        return view('address\detail',
            [ 'page_title' => 'Add new address',
                'action' => '/address',
                'id_user' => $id_user,
                'errors' => $this->valErrors]);
    }

    /** Save a newly created address in database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $address = new Address;
        $isValid = $this->processData($request, $address);

        if ($isValid)
        {
            $address->save();
            return redirect()->action('AddressController@index', ['id_user' => $address->id_user]);
        }
        else
        {
            return view('address\detail',
                [ 'page_title' => 'Add new address',
                    'address' => $address,
                    'action' => '/address',
                    'id_user' => $address->id_user,
                    'errors' => $this->valErrors]);
        }
    }

    /** Show the form for editing the specified address.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $address = Address::find($id);

        return view('address\detail',
            [ 'page_title' => 'Modify address information',
                'address' => $address,
                'action' => '/address/'.$address->id,
                'id_user' => $address->id_user,
                'errors' => $this->valErrors]);
    }

    /** Update the specified address in database.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        $isValid = $this->processData($request, $address);

        if ($isValid)
        {
            $address->save();
            return redirect()->action('AddressController@index',
                ['id_user' => $address->id_user]);
        }
        else
        {
            return view('address\detail',
                [ 'page_title' => 'Modify address information',
                    'address' => $address,
                    'action' => '/address/'.$address->id,
                    'id_user' => $address->id_user,
                    'errors' => $this->valErrors]);
        }
    }

    /** Remove the specified address from database.
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $id_user = $address->id_user;
        $address->delete();

        return redirect()->action('AddressController@index',[ 'id_user' => $id_user ]);
    }

    /** Sanitizing and validating data
     * @param Request $request
     * @return bool
     */
    protected function processData(Request $request, Address $address)
    {
        $result = true;

        $city = $request->City;
        $street = $request->Street;

        // Sanitize and validate form fields

        $this->valErrors['city'] = AddressValidator::validate($city);
        $this->valErrors['street'] = AddressValidator::validate($street);

        $result = (($this->valErrors['city'] == '')
            && ($this->valErrors['street'] == ''));

        // Fill model object with prepared data

        $address->city = $city;
        $address->street = $street;
        $address->id_user = $request->id_user;

        return $result;
    }

}
