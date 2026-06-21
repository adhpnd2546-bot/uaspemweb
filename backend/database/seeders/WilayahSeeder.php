<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatanData = [
            'Nglegok' => ['Jombok', 'Dayu', 'Modangan', 'Sumberasri', 'Kedawung', 'Nglegok', 'Bangsri', 'Krenceng', 'Suka Maju'],
            'Ponggok' => ['Ponggok', 'Pojok', 'Candirejo', 'Gembongan', 'Bacem', 'Kawedusan', 'Ringinanyar', 'Sidorejo', 'Langon', 'Karangbendo', 'Sumber Rejo'],
            'Udanawu' => ['Bakung', 'Sumbersih', 'Tunjung', 'Sukorejo', 'Besuki', 'Mangunan', 'Temenggungan', 'Gondang', 'Karangrejo', 'Tani Makmur'],
            'Garum' => ['Garum', 'Bence', 'Karangrejo', 'Sumberdiren', 'Tingal', 'Sidodadi', 'Slorok', 'Kedungbunder', 'Kebonagung', 'Togogan'],
            'Kademangan' => ['Kademangan', 'Sumberjati', 'Dawuhan', 'Sumberjo', 'Sumberagung', 'Banjarjo', 'Plumpungrejo', 'Suruhwadang', 'Darum', 'Jimbe'],
            'Kanigoro' => ['Kanigoro', 'Satreyan', 'Sawentar', 'Tlogo', 'Kuningan', 'Gaprang', 'Jatinom', 'Minggirsari', 'Papungan', 'Gogodeso'],
            'Wlingi' => ['Wlingi', 'Wlingi Barat', 'Temuwaras', 'Temon', 'Klemunan', 'Tangkil', 'Bangsri', 'Sukoharjo', 'Bendosari', 'Balerejo'],
            'Selopuro' => ['Selopuro', 'Mronjo', 'Ploso', 'Popoh', 'Mandiri', 'Jatitengah', 'Plumbangan', 'Tawangrejo'],
            'Srengat' => ['Srengat', 'Pakisrejo', 'Dermojayan', 'Kaulon', 'Dandong', 'Karanganyar', 'Kebonduren', 'Coper', 'Sragi', 'Kendalrejo'],
        ];

        foreach ($kecamatanData as $kecNama => $desaList) {
            $kec = Kecamatan::create(['nama' => $kecNama]);
            foreach ($desaList as $desaNama) {
                Desa::create(['kecamatan_id' => $kec->id, 'nama' => $desaNama]);
            }
        }
    }
}
