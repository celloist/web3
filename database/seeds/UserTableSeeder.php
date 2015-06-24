<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Group;
use App\Http\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$group = Group::where('name', 'super_admin')->first();

    	if (empty($group) || !isset($group->id)) {
    		throw new Exception("Could not find group!");
    	}

		$user = new User();
		$user->group_id = $group->id;
		$user->username = 'admin';
		$user->password = Hash::make('admin');
		$user->active = true;
		$user->name = 'Admin';
		$user->lastname = 'Istrator';  

        $user->save();
    }
}
