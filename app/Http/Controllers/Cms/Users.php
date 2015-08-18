<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\User;
use App\Http\Models\Group;
use App\Http\Traits\ReturnAssoc;
use Validator;

class Users extends Controller
{
    use ReturnAssoc;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('cms.users.overview', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $groups = $this->getProcessedGroups();
        $countries = $this->getProcessedCountries();

        return view('cms.users.create', ['groups' => $groups, 'countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        return $this->saveUser(new User(), $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('cms.users.delete', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $groups = $this->getProcessedGroups();
        $user = User::find($id);

        return view('cms.users.edit', ['groups' => $groups, 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = User::find($id);

        return $this->saveUser($user, $request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (($user = User::find($id))) {
            $user->delete();
        }

        return redirect()->route('beheer.users.index');
    }

    private function saveUser (User $user, Request $request, $id = 0) {
        $rules = [
            'username' => 'required|unique:users,username,'. $id,
            'password' => 'required|min:4|max:24|confirmed',
            'group_id' => 'required',
            'active'   => 'required',
            'name'     => 'required|min:2',
            'lastname' => 'required|min:2',
            'country'   => 'required|min:4',
            'city'   => 'required|min:4',
            'address'   => 'required|min:4',
            'zip'       => 'required|min:4',
        ];

        $requestData = $request->all();
        $validator = Validator::make($requestData, $rules);
        if (!$validator->fails()) {
            $user->username = $requestData['username'];
            $user->password = bcrypt($requestData['password']);
            $user->group_id = $requestData['group_id'];
            $user->active   = $requestData['active'];
            $user->name     = $requestData['name'];
            $user->lastname     = $requestData['lastname'];
            $user->country     = $requestData['country'];
            $user->city     = $requestData['city'];
            $user->address     = $requestData['address'];
            $user->zip     = $requestData['zip'];

            if ($user->save()){
                return redirect()->route('beheer.users.index');
            } else {
                $validator->errors()->add('main', 'Er is een onbekende fout opgetreden tijdens het opslaan!');
            }
        }

        return redirect()->route('beheer.users.create')
                ->withErrors($validator)
                ->withInput();
    }

    private function getProcessedGroups () {
        $groups = Group::all();

        $return =[];

        foreach ($groups as $group) {
            $return[$group->id] = $group->description;
        }

        return $return;
    }

    /**
     * [getProcessedVat description]
     * @return [type] [description]
     */
    private function getProcessedCountries() {
        $countries = Config::get('static_values.countries');

        return $this->getAssocValues($countries);
    }
}
