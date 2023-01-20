<?php

namespace Database\Seeders;

use App\Models\Unity;
use App\Models\Company;
use Illuminate\Database\Seeder;


class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /**MATRIZ*/
       Company::create([
            'name' => 'HAVAN LOJAS DE DEPARTAMENTOS LTDA',
            'name_fantasy' => 'Lojas Havan',
            'cnpj' => uniqid(),
            'matrix_id' => null,
            'unity_id' => null
        ]);
        /**MATRIZ*/

        $units = Unity::get();

        foreach($units as $unity) {
            Company::create([
                'name' => 'HAVAN LOJAS DE DEPARTAMENTOS LTDA',
                'name_fantasy' => 'Lojas Havan - '.$unity->name ,
                'cnpj' => uniqid(),
                'matrix_id' => 1,
                'unity_id' => $unity->id
            ]);
        }
    }
}
