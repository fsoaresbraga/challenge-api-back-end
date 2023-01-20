<?php

namespace Database\Seeders;

use App\Models\Director;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DirectorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directors = [

            [
                'name' => 'Sul',
                'units' => [
                    ['name' => 'Porto Alegre', 'latitude' => '-30.048750057541955', 'longitude' => '-51.228587422990806'],
                    ['name' => 'Florianopolis', 'latitude' => '-27.55393525017396', 'longitude' => '-48.49841515885026'],
                    ['name' => 'Curitiba', 'latitude' => '-25.473704465731746', 'longitude' => '-49.24787198992874']
                ]
            ],
            [
                'name' => 'Sudeste',
                'units' => [
                    ['name' => 'Sao Paulo', 'latitude' => '-23.544259437612844', 'longitude' => '-46.64370714029131'],
                    ['name' => 'Rio de Janeiro', 'latitude' => '-22.923447510604802', 'longitude' => '-43.23208495438858'],
                    ['name' => 'Belo Horizonte', 'latitude' => '-19.917854829716372', 'longitude' => '-43.94089385954766'],
                    ['name' => 'Vitória', 'latitude' => '-20.340992420772206', 'longitude' => '-40.38332271475097']
                ]
            ],
            [
                'name' => 'Centro-oeste',
                'units' => [
                    ['name' => 'Campo Grande', 'latitude' => '-20.462652006300377', 'longitude' => '-54.615658937666645'],
                    ['name' => 'Goiania', 'latitude' => '-16.673126240814387', 'longitude' => '-49.25248826354209'],
                    ['name' => 'Cuiaba', 'latitude' => '-15.601754458320842', 'longitude' => '-56.09832706558089']
                ]
            ]
       ];

       foreach($directors as $director) {

            $directorInsert = Director::create([
                'name' => $director['name']
            ]);


            foreach($director['units'] as $unity){

                $directorInsert->units()->create([
                    'name' => $unity['name'],
                    'latitude' => $unity['latitude'],
                    'longitude' => $unity['longitude']
                ]);

            }
       }
    }
}
