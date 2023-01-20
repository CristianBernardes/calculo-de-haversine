<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUsers();
    }

    private function createUsers()
    {
        $users = [
            /**
             * Vendedores
             */
            [
                'name' => 'Afonso Afancar',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'afonso.afancar@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Alceu Andreoli',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'alceu.andreoli@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Amalia Zago',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'amalia.zago@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Carlos Eduardo',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'carlos.eduardo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Luiz Felipe',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'luiz.felipe@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Breno',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'breno@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Emanuel',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'emanuel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Ryan',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'ryan@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Vitor Hugo',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'vitor.hugo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Yuri',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'yuri@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Benjamin',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'benjamin@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Erick',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'erick@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Enzo Gabriel',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'enzo.gabriel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Fernando',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'fernando@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Joaquim',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'joaquim@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'André',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'andré@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Raul',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'raul@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Marcelo',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'marcelo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Julio César',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'julio.césar@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Cauê',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'cauê@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Benício',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'benício@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Vitor Gabriel',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'vitor.gabriel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Augusto',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'augusto@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Pedro Lucas',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'pedro.lucas@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Luiz Gustavo',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'luiz.gustavo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Giovanni',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'giovanni@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Renato',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'renato@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Diego',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'diego@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'João Paulo',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'joão.paulo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Renan',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'renan@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Luiz Fernando',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'luiz.fernando@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Anthony',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'anthony@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Lucas Gabriel',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'lucas.gabriel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Thales',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'thales@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Luiz Miguel',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'luiz.miguel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Henry',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'henry@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Marcos Vinicius',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'marcos.vinicius@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Kevin',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'kevin@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Levi',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'levi@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Enrico',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'enrico@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'João Lucas',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'joão.lucas@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Hugo',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'hugo@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Luiz Guilherme',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'luiz.guilherme@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Matheus Henrique',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'matheus.henrique@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Miguel',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'miguel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Davi',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'davi@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Gabriel',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'gabriel@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Arthur',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'arthur@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Lucas',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'lucas@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            [
                'name' => 'Matheus',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'matheus@magazineaziul.com.br',
                'profile_name' => 'salesman'
            ],

            /**
             * Gerentes
             */
            [
                'name' => 'Ronaldinho Gaucho',
                'unit_name' => 'Porto Alegre',
                'board_name' => 'Sul',
                'email' => 'ronaldinho.gaucho@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Roberto Firmino',
                'unit_name' => 'Florianopolis',
                'board_name' => 'Sul',
                'email' => 'roberto.firmino@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Alex de Souza',
                'unit_name' => 'Curitiba',
                'board_name' => 'Sul',
                'email' => 'alex.de.souza@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Françoaldo Souza',
                'unit_name' => 'Sao Paulo',
                'board_name' => 'Sudeste',
                'email' => 'françoaldo.souza@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Romário Faria',
                'unit_name' => 'Rio de Janeiro',
                'board_name' => 'Sudeste',
                'email' => 'romário.faria@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Ricardo Goulart',
                'unit_name' => 'Belo Horizonte',
                'board_name' => 'Sudeste',
                'email' => 'ricardo.goulart@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Dejan Petkovic',
                'unit_name' => 'Vitória',
                'board_name' => 'Sudeste',
                'email' => 'dejan.petkovic@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Deyverson Acosta',
                'unit_name' => 'Campo Grande',
                'board_name' => 'Centro-Oeste',
                'email' => 'deyverson.acosta@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Harlei Silva',
                'unit_name' => 'Goiania',
                'board_name' => 'Centro-Oeste',
                'email' => 'harlei.silva@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            [
                'name' => 'Walter Henrique',
                'unit_name' => 'Cuiaba',
                'board_name' => 'Centro-Oeste',
                'email' => 'walter.henrique@magazineaziul.com.br',
                'profile_name' => 'manager'
            ],

            /**
             * Diretores
             */
            [
                'name' => 'Vagner Mancini',
                'unit_name' => null,
                'board_name' => 'Sul',
                'email' => 'vagner.mancini@magazineaziul.com.br',
                'profile_name' => 'director'
            ],

            [
                'name' => 'Abel Ferreira',
                'unit_name' => null,
                'board_name' => 'Sudeste',
                'email' => 'abel.ferreira@magazineaziul.com.br',
                'profile_name' => 'director'
            ],

            [
                'name' => 'Rogerio Ceni',
                'unit_name' => null,
                'board_name' => 'Centro-oeste',
                'email' => 'rogerio.ceni@magazineaziul.com.br',
                'profile_name' => 'director'
            ],
            /**
             * Diretor Geral
             */
            [
                'name' => 'Edson A. do Nascimento',
                'unit_name' => null,
                'board_name' => null,
                'email' => 'pele@magazineaziul.com.br',
                'profile_name' => 'general_manager'
            ]
        ];

        foreach ($users as $user) {

            $boardId = DB::table('boards')->select('id')->where('board_name', $user['board_name'])->first()->id ?? null;

            $unitId = DB::table('units')->select('id')->where('unit_name', $user['unit_name'])->first()->id ?? null;

            $userId = Str::uuid()->toString();

            DB::table('users')->insert([
                [
                    'id' => $userId,
                    'name' => $user['name'],
                    'email' => stripAccents($user['email']),
                    'password' => Hash::make('mudar123'),
                    'profile' => $user['profile_name'],
                    'created_at' => Carbon::now()
                ]
            ]);

            if ($boardId || $unitId) {

                DB::table('board_unit_users')->insert([
                    [
                        'id' => Str::uuid()->toString(),
                        'user_id' => $userId,
                        'unit_id' => $unitId,
                        'board_id' => $boardId,
                        'created_at' => Carbon::now()
                    ]
                ]);
            }
        }
    }
}
