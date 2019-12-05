<?php

use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++) {
            $extension = new \App\Extensions();
            $extension->name = $faker->words(1, true);
            $extension->author = 1;
            $extension->description = $faker->paragraphs(3, true);
            $extension->rating = mt_rand(1,5);
            $extension->version = 'dev';
            $extension->ratings = mt_rand(0,300);
            $extension->installs = mt_rand(1200, 34000);
            $extension->save();
        }
    }
}
