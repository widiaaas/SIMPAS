<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mentors')->insert([
            [
                'nip_mentor' => '1978151939',
                 'nama' => 'Dra. RR. Ratih Herawati, M.M.',
                 'nomor_telp' => '082934743922',
                 'email' => 'ratiherawati@gmail.com',
                 'alamat' => 'Jl. Petek no.9, Semarang',
                 'kode_instansi' => 'Disdik',
                 'jabatan'=>'Kepala Bidang Pembinaan Paud dan Pnf',
                 'user_id' =>1, 
            ],
            [
                'nip_mentor' => '1980013492',
                'nama' => 'Prananing Nusadhani, S.T., M.T.',
                'nomor_telp' => '082365089672',
                'email' => 'nusadhani@gmail.com',
                'alamat' => 'Jl. Gagak No. 2, Semarang',
                'kode_instansi' => 'Disperkim',
                'jabatan'=>'Kepala Bidang Pertamanan dan Pemakaman',
                'user_id' => 2, // Gantilah dengan user_id yang valid
            ],
            [
                'nip_mentor' => '1982015786',
                'nama' => 'Rochmad Wahyudi, S.E., S.T., M.M.',
                'nomor_telp' => '08137893024',
                'email' => 'rwahyudi@gmail.com',
                'alamat' => 'Jl. Erlangga No. 2, Semarang',
                'kode_instansi' => 'Disperkim',
                'jabatan'=>'Kepala Bidang Permukiman',
                'user_id' => null, // Gantilah dengan user_id yang valid
            ],
            [
               'nip_mentor' => '1980018759',
                'nama' => 'Wiknya, S.Sos., MA',
                'nomor_telp' => '081323810328',
                'email' => 'wiknyaaa@gmail.com',
                'alamat' => 'Jl. MT Haryono No. 4, Semarang',
                'kode_instansi' => 'Disperkim',
                'jabatan'=>'Kepala Rumah Umum dan Rumah Swadaya',
                'user_id' => null, // Gantilah dengan user_id yang valid
            ],
            [
                'nip_mentor' => '1979026152',
                 'nama' => 'Mochamad Hisam Ashari, S.T., M.T.',
                 'nomor_telp' => '082273998793',
                 'email' => 'mhashari@gmail.com',
                 'alamat' => 'Jl. Madukoro no 9, Semarang',
                 'kode_instansi' => 'DPU',
                 'jabatan'=>'Kepala Bidang Sumber Daya Air dan Drainase',
                'user_id' => 4, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1976026152',
                 'nama' => 'Muhammad Teqi Wijaya, S.T., M.T.',
                 'nomor_telp' => '082280294721',
                 'email' => 'teqiwijaya@gmail.com',
                 'alamat' => 'Jl. Pasundan no.30, Semarang',
                 'kode_instansi' => 'DPU',
                 'jabatan'=>'Kepala Bidang Bina Marga',
                 'user_id' => null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1976036122',
                 'nama' => 'Antonius Hariyanto, S.E.',
                 'nomor_telp' => '081789203648',
                 'email' => 'hariyantoo@gmail.com',
                 'alamat' => 'Jl. Gondang Barat no.30, Semarang',
                 'kode_instansi' => 'Dishub',
                 'jabatan'=>'Kepala Bidang Lalu Lintas',
                'user_id' => 3, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979032841',
                 'nama' => 'R. Ambar Prasetyo, S.E.',
                 'nomor_telp' => '08170192831',
                 'email' => 'ambarprasetyo@gmail.com',
                 'alamat' => 'Jl. Pandanaran no.60, Semarang',
                 'kode_instansi' => 'Dishub',
                 'jabatan'=>'Kepala Bidang Angkutan',
                 'user_id' => null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979039882',
                 'nama' => 'Dody Febrianto, S.E.',
                 'nomor_telp' => '081590182493',
                 'email' => 'dfebrianto@gmail.com',
                 'alamat' => 'Jl. Gombel Lama no.9, Semarang',
                 'kode_instansi' => 'Dishub',
                 'jabatan'=>'Kepala Bidang Pengendalian dan Penertiban',
                 'user_id' => null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1987040291',
                 'nama' => 'Irawan Ilham Prajamukti, S.T.',
                 'nomor_telp' => '089363812346',
                 'email' => 'irawanilham@gmail.com',
                 'alamat' => 'Jl. Banjarsari no.3, Semarang',
                 'kode_instansi' => 'DPMPTSP',
                 'jabatan'=>'Kepala Bidang Potensi dan Promosi Penanaman Modal',
                 'user_id' => null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1988042839',
                 'nama' => 'Yulia Adityorini, S.IP.',
                 'nomor_telp' => '0817725110',
                 'email' => 'yuliadityorini@gmail.com',
                 'alamat' => 'Jl. Tunjungsari no.3, Semarang',
                 'kode_instansi' => 'DPMPTSP',
                 'jabatan'=>'Kepala Bidang Penyelenggaraan Layanan Perizinan II',
                 'user_id' => null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1986043058',
                 'nama' => 'Yohanes Fransiscus Yuniar Ronny W., S.T., M.T.',
                 'nomor_telp' => '082398610234',
                 'email' => 'yuniarronny@gmail.com',
                 'alamat' => 'Jl. Erlangga no.9, Semarang',
                 'kode_instansi' => 'DPMPTSP',
                 'jabatan'=>'Kepala Bidang Sistem Informasi dan Monitoring dan Evaluasi Perijinan',
                 'user_id' => null// Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1986051020',
                 'nama' => 'Sri Rahayuningsih, S.Sos., M.M.',
                 'nomor_telp' => '082357819302',
                 'email' => 'srirahayu@gmail.com',
                 'alamat' => 'Jl. Peterongan no.3A, Semarang',
                 'kode_instansi' => 'DKP',
                 'jabatan'=>'Kepala Bidang Ketersediaan dan Kewaspadaan Pangan',
                 'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1987052239',
                 'nama' => 'Suherminati, S.E., M.M.',
                 'nomor_telp' => '082203041234',
                 'email' => 'suherminati@gmail.com',
                 'alamat' => 'Jl. Candi no.7, Semarang',
                 'kode_instansi' => 'DKP',
                 'jabatan'=>'Kepala Bidang Distribusi dan Cadangan Pangan',
                 'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1988053124',
                 'nama' => 'Aniya Widiyani, S.TP., M.P.',
                 'nomor_telp' => '087863524080',
                 'email' => 'aniyawidiyani@gmail.com',
                 'alamat' => 'Jl. Tembalang Baru no.7, Semarang',
                 'kode_instansi' => 'DKP',
                 'jabatan'=>'Kepala Bidang Konsumsi, Penganekaragaman, dan Pengembangan Pangan',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1978061726',
                 'nama' => 'Glory Nasarani, S.T.,M.T.,M.Sc.',
                 'nomor_telp' => '087829304761',
                 'email' => 'glorynasarani@gmail.com',
                 'alamat' => 'Jl. Sukun no.1, Semarang',
                 'kode_instansi' => 'DLH',
                 'jabatan'=>'Kepala Bidang Penataan Lingkungan Hidup',
                'user_id' =>null, 
             ],
             [
                'nip_mentor' => '1978061029',
                 'nama' => 'Adi Jatmiko, S.T.,M.Eng.',
                 'nomor_telp' => '087890182934',
                 'email' => 'adijatmiko@gmail.com',
                 'alamat' => 'Jl. Durian Raya no.6, Semarang',
                 'kode_instansi' => 'DLH',
                 'jabatan'=>'Kepala Bidang Pengelolaan Sampah',
                'user_id' =>null, 
             ],
             [
                'nip_mentor' => '1980062278',
                 'nama' => 'Dr.Ling. Safrinal Sofaniadi, S.T., M.Si.',
                 'nomor_telp' => '082273912034',
                 'email' => 'safrinalsofaniadi@gmail.com',
                 'alamat' => 'Jl. Trenggiling no. 10, Semarang',
                 'kode_instansi' => 'DLH',
                 'jabatan'=>'Kepala Bidang Pengendalian Pencemaran dan Konservasi Lingkungan Hidup',
                'user_id' =>null, 
             ],
             [
                'nip_mentor' => '1981071872',
                 'nama' => 'Nanie Widyanti, S.E.',
                 'nomor_telp' => '081389203741',
                 'email' => 'naniewidyanti@gmail.com',
                 'alamat' => 'Jl. Prof.Soedarto no. 18, Semarang',
                 'kode_instansi' => 'Disarpus',
                 'jabatan'=>'Kepala Bidang Pengelolaan dan Layanan Kearsipan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1975072896',
                 'nama' => 'Titik Suharni, S.H., M.Si.',
                 'nomor_telp' => '082240516975',
                 'email' => 'titiksuharni@gmail.com',
                 'alamat' => 'Jl. Mulawarman Raya no.18, Semarang',
                 'kode_instansi' => 'Disarpus',
                 'jabatan'=>'Kepala Bidang Pengembangan dan Pengelolaan Bahan Perpustakaan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1984073890',
                 'nama' => 'Yuni Sailawati, S.K.M.',
                 'nomor_telp' => '081302939145',
                 'email' => 'yunisailawati@gmail.com',
                 'alamat' => 'Jl. Setiabudi no. 29, Semarang',
                 'kode_instansi' => 'Disarpus',
                 'jabatan'=>'Kepala Bidang Pemberdayaan dan Layanan Perpustakaan',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1985081894',
                 'nama' => 'Siti Arkunah, S.Kom., M.Kom.',
                 'nomor_telp' => '081729301842',
                 'email' => 'sitiarkunah@gmail.com',
                 'alamat' => 'Jl. Randusari no.2, Semarang',
                 'kode_instansi' => 'Disperindag',
                 'jabatan'=>'Kepala Bidang Pengembangan Perdagangan dan Stabilitas Harga',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1987082049',
                 'nama' => 'Lilis Wahyuningsih, S.IP.',
                 'nomor_telp' => '082290418492',
                 'email' => 'liliswahyuningsih@gmail.com',
                 'alamat' => 'Jl. Pemuda no.2, Semarang',
                 'kode_instansi' => 'Disperindag',
                 'jabatan'=>'Kepala Bidang Bina Usaha',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979083985',
                 'nama' => 'Ughari Fajar Dewangga, S.H.',
                 'nomor_telp' => '082389401728',
                 'email' => 'fajardewangga@gmail.com',
                 'alamat' => 'Jl. Sumurboto no.16, Semarang',
                 'kode_instansi' => 'Disperindag',
                 'jabatan'=>'Kepala Bidang Pengembangan Prasarana dan Sarana Perdagangan',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979091023',
                 'nama' => 'Agustina Widyastuti, S.Sos, M.M.',
                 'nomor_telp' => '082490316367',
                 'email' => 'tinawidyastuti@gmail.com',
                 'alamat' => 'Jl. Pandega no. 5, Semarang',
                 'kode_instansi' => 'Disperin',
                 'jabatan'=>'Kepala Bidang Industri Logam, Mesin, Alat Transportasi dan Telematika dan Elektronika',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1983092901',
                 'nama' => 'Janatul Husnah, S.E., M.M.',
                 'nomor_telp' => '082399271044',
                 'email' => 'janatulhusna@gmail.com',
                 'alamat' => 'Jl. Tumpang no. 2, Semarang',
                 'kode_instansi' => 'Disperin',
                 'jabatan'=>'Kepala Bidang Industri Kimia dan Tekstil',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979093892',
                 'nama' => 'Mekarsari Sulistiasningrum, S.Sos, M.M.',
                 'nomor_telp' => '088200318372',
                 'email' => 'mekarsari@gmail.com',
                 'alamat' => 'Jl. Ngesrep Timur no.17, Semarang',
                 'kode_instansi' => 'Disperin',
                 'jabatan'=>'Kepala Bidang Industri Agro dan Hasil Hutan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1980101234',
                 'nama' => 'Puspita Rini, S.H.',
                 'nomor_telp' => '082298401932',
                 'email' => 'puspitarini@gmail.com',
                 'alamat' => 'Jl. Ngesrep Timur no.20, Semarang',
                 'kode_instansi' => 'Dinsos',
                 'jabatan'=>'Kepala Bidang Pemberdayaan Sosial',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1978102249',
                 'nama' => 'Endah Margya Suksmawati, S.IP., M.M.',
                 'nomor_telp' => '081820472947',
                 'email' => 'endahsuksmawati@gmail.com',
                 'alamat' => 'Jl. Margahayu no. 4, Semarang',
                 'kode_instansi' => 'Dinsos',
                 'jabatan'=>'Kepala Bidang Rehabilitasi Sosial',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979103018',
                 'nama' => 'Primasari Yuswardhani Suryaningtyas, S.H., M.M.',
                 'nomor_telp' => '081893025723',
                 'email' => 'primasuryaningtyas@gmail.com',
                 'alamat' => 'Jl. Kaligawe no. 4, Semarang',
                 'kode_instansi' => 'Dinsos',
                 'jabatan'=>'Kepala Bidang Jaminan Sosial',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1979111930',
                 'nama' => 'Willar Haruman, S.E., M.M.',
                 'nomor_telp' => '088203830582',
                 'email' => 'wharuman@gmail.com',
                 'alamat' => 'Jl. Madukoro no.20, Semarang',
                 'kode_instansi' => 'Disnaker',
                 'jabatan'=>'Kepala Bidang Pelatihan Tenaga Kerja',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1982112404',
                 'nama' => 'Erlina Yulianti, S.E.',
                 'nomor_telp' => '081394012484',
                 'email' => 'erlinayulianti@gmail.com',
                 'alamat' => 'Jl. Erlangga Timur no. 23, Semarang',
                 'kode_instansi' => 'Disnaker',
                 'jabatan'=>'Kepala Bidang Informasi Pasar Kerja dan Produktivitas Kerja',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1980121930',
                 'nama' => 'Sugeng Dilianto, S.H.',
                 'nomor_telp' => '081730283728',
                 'email' => 'sugengdilianto@gmail.com',
                 'alamat' => 'Jl. Kauman no. 13, Semarang',
                 'kode_instansi' => 'Dispora',
                 'jabatan'=>'Kepala Bidang Pembinaan dan Prestasi Olahraga',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1981122042',
                 'nama' => 'Afriana Kusumawardhani, S.Psi., M.M.',
                 'nomor_telp' => '08139287950',
                 'email' => 'afrianakw@gmail.com',
                 'alamat' => 'Jl. Sriwijaya no.8, Semarang',
                 'kode_instansi' => 'Dispora',
                 'jabatan'=>'Kepala Bidang Pengembangan Pemuda',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1988123941',
                 'nama' => 'Triyo Sumanto, S.E.,M.M.',
                 'nomor_telp' => '081908432711',
                 'email' => 'triyosumanto@gmail.com',
                 'alamat' => 'Jl. M.T. Haryono no. 55, Semarang',
                 'kode_instansi' => 'Dispora',
                 'jabatan'=>'Kepala Bidang Pemberdayaan Olahraga',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1978131923',
                 'nama' => 'Masithoh, S.Pi.,M.Si.',
                 'nomor_telp' => '089930371824',
                 'email' => 'masithoh@gmail.com',
                 'alamat' => 'Jl. Anggrek Raya no.27, Semarang',
                 'kode_instansi' => 'Dispi',
                 'jabatan'=>'Kepala Bidang Perikanan Tangkap',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1978141203',
                 'nama' => 'Siti Minasari, S.K.M., M.Kes.',
                 'nomor_telp' => '082891024821',
                 'email' => 'sitiminasari@gmail.com',
                 'alamat' => 'Jl. Bougenville no.19, Semarang',
                 'kode_instansi' => 'Dinkes',
                 'jabatan'=>'Kepala Bidang Kesehatan Masyarakat',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1988142031',
                 'nama' => 'Nur Dian Rakhmawati, S.Kep.Ners, MPH',
                 'nomor_telp' => '082268744216',
                 'email' => 'dianrakhmawati@gmail.com',
                 'alamat' => 'Jl. Kenanga no.1, Semarang',
                 'kode_instansi' => 'Dinkes',
                 'jabatan'=>'Kepala Bidang Pelayanan Kesehatan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1986143931',
                 'nama' => 'dr. Muhammad Hidayanto',
                 'nomor_telp' => '081893024942',
                 'email' => 'mhidayanto@gmail.com',
                 'alamat' => 'Jl. Kertanegara Selatan no. 5, Semarang',
                 'kode_instansi' => 'Dinkes',
                 'jabatan'=>'Kepala Bidang Sumber Daya Kesehatan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
             ],
             [
                'nip_mentor' => '1978152933',
                 'nama' => 'Dr. Miftahudin, S.Pd.,M.Si.',
                 'nomor_telp' => '082394957743',
                 'email' => 'miftahudin@gmail.com',
                 'alamat' => 'Jl. Ariloka no.4, Semarang',
                 'kode_instansi' => 'Disdik',
                 'jabatan'=>'Kepala Bidang Pembinaan Guru dan Tenaga Kependidikan',
                'user_id' =>null, // Gantilah dengan user_id yang valid
             ],      
             
             [
               'nip_mentor' => '1978152933',
                'nama' => 'Dr. Miftahudin, S.Pd.,M.Si.',
                'nomor_telp' => '082394957743',
                'email' => 'miftahudin@gmail.com',
                'alamat' => 'Jl. Ariloka no.4, Semarang',
                'kode_instansi' => 'Disdik',
                'jabatan'=>'Kepala Bidang Pembinaan Guru dan Tenaga Kependidikan',
               'user_id' =>null, // Gantilah dengan user_id yang valid
            ], 
        ]);
    }
}
