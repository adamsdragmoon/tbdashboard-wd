<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Grab extends Model
class Grab
{
    // use HasFactory;
    private static $grabbed_data = [ 
        [
                'uuid' => '1',
                'tglwktrequest' => '2021-01-01',
                'wakturequest' => '15:30:02', 
                'tglinput' => '2021-01-01',
                'waktuinput' => '15:33:12',
                'memberid' => 'kolonel',
                'saldomember' => '2000000',
                'namarek' => 'Kolonel Geraldine',
                'kategorirek' => 'bank',
                'detailrek' => 'BCA 1234567890',
                'jumlahwd' => '1000000',
                'agent' => 'bacan4d',
                'status' => 'open',
                'createdby' => 'bacanop01',
            ],
            [
                'uuid' => '2',
                'tglrequest' => '2023-01-01',
                'wakturequest' => '15:30:02', 
                'tglinput' => '2023-01-01',
                'waktuinput' => '15:33:12',
                'memberid' => 'suparman',
                'saldomember' => '1000000',
                'namarek' => 'Clark Kent',
                'kategorirek' => 'ewallet',
                'detailrek' => 'OVO 1234567890',
                'jumlahwd' => '500000',
                'agent' => 'aceh4d',
                'status' => 'open',
                'createdby' => 'acehop01',
            ],
            [
                'uuid' => '3',
                'tglrequest' => '2022-01-01',
                'wakturequest' => '15:30:02', // 'wakturequest' => '15:33:12
                'tglinput' => '2022-01-01',
                'waktuinput' => '15:33:12',
                'memberid' => 'bambang',
                'saldomember' => '7000000',
                'namarek' => 'Clark Kent',
                'kategorirek' => 'ewallet',
                'detailrek' => 'GOPAY 1234567890',
                'jumlahwd' => '100000',
                'agent' => 'terminal4d',
                'status' => 'open',
                'createdby' => 'terminalop01',
            ]
    ];

    public static function getGrabbedData() {
        return collect(self::$grabbed_data);
    }

    public static function getGrabbedDataByUuid($uuid) {
        $process_data = static::getGrabbedData();
        return $process_data->firstWhere('uuid', $uuid);
    }

}
