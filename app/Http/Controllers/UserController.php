<?php namespace App\Http\Controllers;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use Illuminate\Http\Request;

use App\Http\Validators\NameValidator;
use App\Address;
use App\User;

class UserController extends Controller
{
    private $valErrors = array();

    /** Display a list of users.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $errors = $this->checkDB();
        if ($errors == '')
        {
            $users = User::all();
        }
        else
        {
            $users = '';
            $this->valErrors['db_connection'] = $errors;
            $this->valErrors['db_create'] =
                'You need to create database before using this website
                (\database\scripts\create_db.sql). Check also your configuration.';
        }

        return view('user\index',
            [ 'page_title' => 'List of users',
                'users' => $users,
                'errors' => $this->valErrors]);
    }

    /** Show the form for creating a new user.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user\detail',
            [ 'page_title' => 'Create new user',
                'action' => '/user',
                'errors' => $this->valErrors]);
    }

    /** Save a newly created user in database.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user_count = User::where('name','=',$request->Name)
            ->count();

        if ($user_count > 0 )
            $this->valErrors['name'] = 'User with this name already exists.';
        else
        {
            $name = $request->Name;
            $this->valErrors['name'] = NameValidator::validate($name);
        }

        $user = new User;
        $user->name = $name;

        if ($this->valErrors['name'] == '')
        {
            $user->save();
            return redirect()->action('UserController@index');
        }
        else
        {
            return view('user\detail',
                [ 'page_title' => 'Create new user',
                    'user' => $user,
                    'action' => '/user',
                    'errors' => $this->valErrors]);
        }
    }

    /** Display addresses of the specified user.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        return redirect()->action('AddressController@index',[ 'id_user' => $id ]);
    }

    /** Show the form for editing the specified user.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user\detail',
            [ 'page_title' => 'Modify user information',
                'user' => $user,
                'action' => '/user/'.$user->id,
                'errors' => $this->valErrors]);
    }

    /** Update the specified user in database.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $name = $request->Name;
        $this->valErrors['name'] = NameValidator::validate($name);

        $user = User::find($id);
        $user->name = $name;

        if ($this->valErrors['name'] == '')
        {
            $user->save();
            return redirect()->action('UserController@index');
        }
        else
        {
            return view('user\detail',
                [ 'page_title' => 'Modify user information',
                    'user' => $user,
                    'action' => '/user/'.$user->id,
                    'errors' => $this->valErrors]);
        }
    }

    /** Remove the specified user and its addresses from database.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Address::where('id_user','=',$id)
            ->delete();

        $user = User::find($id);
        $user->delete();

        return redirect()->action('UserController@index');
    }

    /** Checking connection to the database
     * @return string
     */
    private function checkDB()
    {
        try
        {
            $db = DB::select('SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?',
                ['users_manager_db']);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }

        try
        {
            DB::connection()->getPdo();
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }

        return '';
    }
}
