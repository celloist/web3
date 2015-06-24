<?php

use Illuminate\Database\Seeder;
use App\Http\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$groups = [
    		'super_admin',
    		'cms_admin',
    		'user'
    	];

    	foreach ($groups as $groupName) {    		
    		$group = new Group();
	        $group->name = $groupName;

	        if (!$group->save()){
	        	throw new Exception("Could not save group: ". $groupName);
	        }	
    	}
        

    }
}
