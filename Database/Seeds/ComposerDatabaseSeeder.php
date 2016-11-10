<?php
namespace App\Modules\Composer\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ComposerDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\Composer\Database\Seeds\FoobarTableSeeder');

        Model::reguard();

	}

}
