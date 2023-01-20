<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createBoards();
        $this->createUnits();
        $this->call([
            UsersTableSeeder::class,
        ]);
    }

    private function createBoards()
    {
        $boards = ['Sul', 'Sudeste', 'Centro-oeste'];

        foreach ($boards as $board) {
            DB::table('boards')->insert([
                [
                    'id' => Str::uuid()->toString(),
                    'board_name' => $board,
                    'created_at' => Carbon::now()
                ]
            ]);
        }
    }

    private function createUnits()
    {
        $units = [
            [
                'unit_name' => 'Porto Alegre',
                'lat_lon' => '-30.048750057541955,-51.228587422990806',
                'board_name' => 'Sul'
            ],

            [
                'unit_name' => 'Florianopolis',
                'lat_lon' => '-27.55393525017396,-48.49841515885026',
                'board_name' => 'Sul'
            ],

            [
                'unit_name' => 'Curitiba',
                'lat_lon' => '-25.473704465731746,-49.24787198992874',
                'board_name' => 'Sul'
            ],

            [
                'unit_name' => 'Sao Paulo',
                'lat_lon' => '-23.544259437612844,-46.64370714029131',
                'board_name' => 'Sudeste'
            ],

            [
                'unit_name' => 'Rio de Janeiro',
                'lat_lon' => '-22.923447510604802,-43.23208495438858',
                'board_name' => 'Sudeste'
            ],

            [
                'unit_name' => 'Belo Horizonte',
                'lat_lon' => '-19.917854829716372,-43.94089385954766',
                'board_name' => 'Sudeste'
            ],

            [
                'unit_name' => 'Vitória',
                'lat_lon' => '-20.340992420772206,-40.38332271475097',
                'board_name' => 'Sudeste'
            ],

            [
                'unit_name' => 'Campo Grande',
                'lat_lon' => '-20.462652006300377,-54.615658937666645',
                'board_name' => 'Centro-Oeste'
            ],

            [
                'unit_name' => 'Goiania',
                'lat_lon' => '-16.673126240814387,-49.25248826354209',
                'board_name' => 'Centro-Oeste'
            ],

            [
                'unit_name' => 'Cuiaba',
                'lat_lon' => '-15.601754458320842,-56.09832706558089',
                'board_name' => 'Centro-Oeste'
            ]
        ];

        foreach ($units as $unit) {

            $boardId = DB::table('boards')->select('id')->where('board_name', $unit['board_name'])->first()->id;

            $latLon = explode(',', $unit['lat_lon']);

            DB::table('units')->insert([
                [
                    'id' => Str::uuid()->toString(),
                    'board_id' => $boardId,
                    'unit_name' => $unit['unit_name'],
                    'latitude' => $latLon[0],
                    'longitude' => $latLon[1],
                    'created_at' => Carbon::now()
                ]
            ]);
        }
    }
}
