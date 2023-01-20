<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Unity;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //**Perfil usuario*/

        UserProfile::create(['name' => "Vendedor"]);
        UserProfile::create(['name' => "Gerente"],);
        UserProfile::create(['name' => "Diretor"],);
        UserProfile::create(['name' => "Diretor Geral"]);

        //**Perfil usuario*/

        $sellers = [

            ['name' => 'Afonso Afancar', 'unity' => 'Belo Horizonte', 'email' => 'afonso.afancar@magazineaziul.com.br'],

            ['name' => 'Alceu Andreoli','unity' => 'Belo Horizonte', 'email' => 'alceu.andreoli@magazineaziul.com.br'],

            ['name' => 'Amalia Zago',	'unity' => 'Belo Horizonte', 'email' => 'amalia.zago@magazineaziul.com.br'],

            ['name' => 'Carlos Eduardo',	'unity' => 'Belo Horizonte', 'email' => 'carlos.eduardo@magazineaziul.com.br'],

            ['name' => 'Luiz Felipe',	'unity' => 'Belo Horizonte', 'email' => 'luiz.felipe@magazineaziul.com.br'],

            ['name' => 'Breno', 'unity' => 'Campo Grande', 'email' => 'breno@magazineaziul.com.br'],

            ['name' => 'Emanuel', 'unity' => 'Campo Grande', 'email' => 'emanuel@magazineaziul.com.br'],

            ['name' => 'Ryan', 'unity' => 'Campo Grande', 'email' => 'ryan@magazineaziul.com.br'],

            ['name' => 'Vitor Hugo', 'unity' => 'Campo Grande', 'email' => 'vitor.hugo@magazineaziul.com.br'],

            ['name' => 'Yuri', 'unity' => 'Campo Grande', 'email' => 'yuri@magazineaziul.com.br'],

            ['name' => 'Benjamin', 'unity' => 'Cuiaba', 'email' => 'benjamin@magazineaziul.com.br'],

            ['name' => 'Erick', 'unity' => 'Cuiaba', 'email' => 'erick@magazineaziul.com.br'],

            ['name' => 'Enzo Gabriel', 'unity' => 'Cuiaba',	'email' => 'enzo.gabriel@magazineaziul.com.br'],

            ['name' => 'Fernando', 'unity' => 'Cuiaba', 'email' => 'fernando@magazineaziul.com.br'],

            ['name' => 'Joaquim', 'unity' => 'Cuiaba', 'email' => 'joaquim@magazineaziul.com.br'],

            ['name' => 'André', 'unity' => 'Curitiba', 'email' => 'andré@magazineaziul.com.br'],

            ['name' => 'Raul', 'unity' => 'Curitiba', 'email' => 'raul@magazineaziul.com.br'],

            ['name' => 'Marcelo', 'unity' => 'Curitiba', 'email' => 'marcelo@magazineaziul.com.br'],

            ['name' => 'Julio César', 'unity' => 'Curitiba', 'email' => 'julio.césar@magazineaziul.com.br'],

            ['name' => 'Cauê', 'unity' => 'Curitiba', 'email' => 'cauê@magazineaziul.com.br'],

            ['name' => 'Benício', 'unity' => 'Florianopolis', 'email' => 'benício@magazineaziul.com.br'],

            ['name' => 'Vitor Gabriel', 'unity' => 'Florianopolis', 'email' => 'vitor.gabriel@magazineaziul.com.br'],

            ['name' => 'Augusto', 'unity' => 'Florianopolis', 'email' => 'augusto@magazineaziul.com.br'],

            ['name' => 'Pedro Lucas', 'unity' => 'Florianopolis', 'email' => 'pedro.lucas@magazineaziul.com.br'],

            ['name' => 'Luiz Gustavo', 'unity' => 'Florianopolis', 'email' => 'luiz.gustavo@magazineaziul.com.br'],

            ['name' => 'Giovanni', 'unity' => 'Goiania', 'email' => 'giovanni@magazineaziul.com.br'],

            ['name' => 'Renato', 'unity' => 'Goiania', 'email' => 'renato@magazineaziul.com.br'],

            ['name' => 'Diego', 'unity' => 'Goiania', 'email' => 'diego@magazineaziul.com.br'],

            ['name' => 'João Paulo', 'unity' => 'Goiania', 'email' => 'joão.paulo@magazineaziul.com.br'],

            ['name' => 'Renan', 'unity' => 'Goiania', 'email' => 'renan@magazineaziul.com.br'],

            ['name' => 'Luiz Fernando', 'unity' => 'Porto Alegre', 'email' => 'luiz.fernando@magazineaziul.com.br'],

            ['name' => 'Anthony', 'unity' => 'Porto Alegre', 'email' => 'anthony@magazineaziul.com.br'],

            ['name' => 'Lucas Gabriel', 'unity' => 'Porto Alegre', 'email' => 'lucas.gabriel@magazineaziul.com.br'],

            ['name' => 'Thales', 'unity' => 'Porto Alegre', 'email' => 'thales@magazineaziul.com.br'],

            ['name' => 'Luiz Miguel', 'unity' => 'Porto Alegre', 'email' => 'luiz.miguel@magazineaziul.com.br'],

            ['name' => 'Henry', 'unity' => 'Rio de Janeiro', 'email' => 'henry@magazineaziul.com.br'],

            ['name' => 'Marcos Vinicius', 'unity' => 'Rio de Janeiro', 'email' => 'marcos.vinicius@magazineaziul.com.br'],

            ['name' => 'Kevin', 'unity' => 'Rio de Janeiro', 'email' => 'kevin@magazineaziul.com.br'],

            ['name' => 'Levi', 'unity' => 'Rio de Janeiro', 'email' => 'levi@magazineaziul.com.br'],

            ['name' => 'Enrico', 'unity' => 'Rio de Janeiro', 'email' => 'enrico@magazineaziul.com.br'],

            ['name' => 'João Lucas', 'unity' => 'Sao Paulo', 'email' => 'joão.lucas@magazineaziul.com.br'],

            ['name' => 'Hugo', 'unity' => 'Sao Paulo', 'email' => 'hugo@magazineaziul.com.br'],

            ['name' => 'Luiz Guilherme', 'unity' => 'Sao Paulo', 'email' => 'luiz.guilherme@magazineaziul.com.br'],

            ['name' => 'Matheus Henrique', 'unity' => 'Sao Paulo', 'email' => 'matheus.henrique@magazineaziul.com.br'],

            ['name' => 'Miguel', 'unity' => 'Sao Paulo', 'email' => 'miguel@magazineaziul.com.br'],

            ['name' => 'Davi', 'unity' => 'Vitória', 'email' => 'davi@magazineaziul.com.br'],

            ['name' => 'Gabriel', 'unity' => 'Vitória', 'email' => 'gabriel@magazineaziul.com.br'],

            ['name' => 'Arthur', 'unity' => 'Vitória', 'email' => 'arthur@magazineaziul.com.br'],

            ['name' => 'Lucas', 'unity' => 'Vitória', 'email' => 'lucas@magazineaziul.com.br'],

            ['name' => 'Matheus', 'unity' => 'Vitória',	'email' => 'matheus@magazineaziul.com.br'],



        ];

        foreach($sellers as $salesman) {
            $unity = Unity::with('company')->where('nome',  $salesman['unity'])->first();

            User::create([
                'profile_id' => 1,
                'company_id' => $unity->company->id,
                'name' => $salesman['name'],
                'email' => $salesman['email'],
                'password' => Hash::make('123mudar'),

            ]);
        }

        $managers = [
            ['name' => 'Ronaldinho Gaucho', 'unity' => 'Porto Alegre',	'email' => 'ronaldinho.gaucho@magazineaziul.com.br'],
            ['name' => 'Roberto Firmino', 'unity' => 'Florianopolis',	'email' => 'roberto.firmino@magazineaziul.com.br'],
            ['name' => 'Alex de Souza', 'unity' => 'Curitiba',	'email' => 'alex.de.souza@magazineaziul.com.br'],
            ['name' => 'Françoaldo Souza', 'unity' => 'Sao Paulo',	'email' => 'françoaldo.souza@magazineaziul.com.br'],
            ['name' => 'Romário Faria', 'unity' => 'Rio de Janeiro',	'email' => 'romário.faria@magazineaziul.com.br'],
            ['name' => 'Ricardo Goulart', 'unity' => 'Belo Horizonte',	'email' => 'ricardo.goulart@magazineaziul.com.br'],
            ['name' => 'Dejan Petkovic', 'unity' => 'Vitória',	'email' => 'dejan.petkovic@magazineaziul.com.br'],
            ['name' => 'Deyverson Acosta', 'unity' => 'Campo Grande',	'email' => 'deyverson.acosta@magazineaziul.com.br'],
            ['name' => 'Harlei Silva', 'unity' => 'Goiania',	'email' => 'harlei.silva@magazineaziul.com.br'],
            ['name' => 'Walter Henrique', 'unity' => 'Cuiaba',	'email' => 'walter.henrique@magazineaziul.com.br'],

        ];

        foreach($managers as $manager) {
            $unity = Unity::with('company')->where('nome',  $manager['unity'])->first();

            User::create([
                'profile_id' => 2,
                'company_id' => $unity->company->id,
                'name' => $manager['name'],
                'email' => $manager['email'],
                'password' => Hash::make('123mudar'),

            ]);
        }

        $directors = [
            ['name' => 'Vagner Mancini', 'unity' => 'Porto Alegre',	'email' => 'vagner.mancini@magazineaziul.com.br'],
            ['name' => 'Abel Ferreira', 'unity' => 'Sao Paulo',	'email' => 'abel.ferreira@magazineaziul.com.br'],
            ['name' => 'Rogerio Ceni', 'unity' => 'Goiania',	'email' => 'rogerio.ceni@magazineaziul.com.br'],

        ];

        foreach($directors as $director) {
            $unity = Unity::with('company')->where('nome',  $director['unity'])->first();

            User::create([
                'profile_id' => 3,
                'company_id' => $unity->company->id,
                'name' => $director['name'],
                'email' => $director['email'],
                'password' => Hash::make('123mudar'),

            ]);
        }

        //DIRETOR GERAL
        User::create([
            'profile_id' => 4,
            'company_id' => 1,
            'name' => 'Edson A. do Nascimento',
            'email' => 'pele@magazineaziul.com.br',
            'password' => Hash::make('123mudar'),

        ]);
        //DIRETOR GERAL
    }
}
