<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;
use App\Http\Controllers\BridgingController;

use App\Models\Antibiotik;
use App\Models\Bakteri;
use App\Models\BakteriDetail;
use App\Models\CaraMasuk;
use App\Models\Dokter;
use App\Models\DokterPJ;
use App\Models\Duplo;
use App\Models\DuploDetail;
use App\Models\DuploOri;
use App\Models\DuploOriDetail;
use App\Models\Grub;
use App\Models\GrubDetail;
use App\Models\Histori;
use App\Models\Instalasi;
use App\Models\JenisPemeriksaan;
use App\Models\KategoriCatatan;
use App\Models\KelasPasien;
use App\Models\KetKlinis;
use App\Models\KodeLab;
use App\Models\KodeLabDetail;
use App\Models\KodeLabHasil;
use App\Models\KontenCatatan;
use App\Models\LabKulturAntibiotik;
use App\Models\LabKulturBakteri;
use App\Models\LISOrder;
use App\Models\LISOrderDetail;
use App\Models\LISOrderDuplikat;
use App\Models\LISHasilDetail;
use App\Models\OrderAlatKimia;
use App\Models\OrderSimrs;
use App\Models\PaketAntibiotik;
use App\Models\PaketAntibiotikDetail;
use App\Models\PaketLab;
use App\Models\PaketLabDetail;
use App\Models\PaketSumsumTulang;
use App\Models\PaketSumsumTulangDetail;
use App\Models\Pasien;
use App\Models\PetugasLab;
use App\Models\ReportKritis;
use App\Models\Ruangan;
use App\Models\SIMRSHasil;
use App\Models\SIMRSHasilAntibiotik;
use App\Models\SIMRSHasilKultur;
use App\Models\SIMRSHasilSumsum;
use App\Models\SIMRSHasilText;
use App\Models\SIMRSHasilTextFooter;
use App\Models\SIMRSOrderLab;
use App\Models\Setting;
use App\Models\Specimen;
use App\Models\StatusAsuransi;
use App\Models\StatusCito;
use App\Models\StatusKirimSimrs;
use App\Models\TAT;
use App\Models\TempSimrs;
use App\Models\TransaksiCovid;
use App\Models\TransaksiKultur;
use App\Models\TransaksiKulturSperma;
use App\Models\TransaksiLab;
use App\Models\TransaksiLabAntibiotik;
use App\Models\TransaksiLabDeskripsi;
use App\Models\TransaksiLabDetail;
use App\Models\TransaksiLabGDT;
use App\Models\TransaksiLabKilinics;
use App\Models\TransaksiLabKultur;
use App\Models\TransaksiLabSumsumTulang1;
use App\Models\TransaksiLabSumsumTulang2;
use App\Models\TransaksiLabSumsumTulang3;
use App\Models\TransaksiPaketLab;
use App\Models\User;
use App\Models\WaktuPemeriksaan;


use Carbon\Carbon;

class OrderLabController extends Controller
{
    public function OrderLab()
    {
        $setting = Setting::first();
        $order_lab_cek = LISOrder::orderBy('tgl_order', 'asc')
        ->where('status', 0)
        ->first();

        if($order_lab_cek){
            //Pasien
            $pasien = Pasien::where('kode_rm',  $order_lab_cek->no_rm)->first();
            if(!$pasien){
                $jk = array();
                $jk['P'] = 0;
                $jk['L'] = 1;

                $pasien_simpan = new Pasien();
                $pasien_simpan->kode_rm  = $order_lab_cek->no_rm;
                $pasien_simpan->nama  = $order_lab_cek->nama_pas;
                $pasien_simpan->tgl_lahir  = date_create($order_lab_cek->tgl_lahir);
                $pasien_simpan->jenis_kelamin  = $jk[$order_lab_cek->jenis_kel];
                $pasien_simpan->alamat  = $order_lab_cek->alamat;
                $pasien_simpan->save();
            }
            $pasien = Pasien::where('kode_rm',  $order_lab_cek->no_rm)->first();

            //Asuransi
            $asuransi = StatusAsuransi::where('nama_asuransi', $order_lab_cek->cara_bayar)
            ->where('kode_his', $order_lab_cek->kode_cara_bayar)
            ->first();
            if(!$asuransi){
                $asuransi_simpan = new StatusAsuransi();
                $asuransi_simpan->nama_asuransi = $order_lab_cek->cara_bayar;
                $asuransi_simpan->kode_his = $order_lab_cek->kode_cara_bayar;
                $asuransi_simpan->save();
            }
            $asuransi = StatusAsuransi::where('nama_asuransi', $order_lab_cek->cara_bayar)
            ->where('kode_his', $order_lab_cek->kode_cara_bayar)
            ->first();

            //Ruangan
            $ruangan = Ruangan::where('nama_ruangan', $order_lab_cek->nama_ruang)
            ->where('kode_his', $order_lab_cek->kode_ruang)
            ->first();
            if(!$ruangan){
                $ruangan_simpan = new Ruangan();
                $ruangan_simpan->nama_ruangan = $order_lab_cek->nama_ruang;
                $ruangan_simpan->kode = $order_lab_cek->kode_ruang;
                $ruangan_simpan->kode_his = $order_lab_cek->kode_ruang;
                $ruangan_simpan->save();
            }
            $ruangan = Ruangan::where('nama_ruangan', $order_lab_cek->nama_ruang)
            ->where('kode_his', $order_lab_cek->kode_ruang)
            ->first();

            //Cara Masuk
            $cara_masuk = CaraMasuk::where('nama', $order_lab_cek->jns_rawat)
            ->first();
            if(!$cara_masuk){
                $cara_masuk_simpan = new CaraMasuk();
                $cara_masuk_simpan->nama = $order_lab_cek->jns_rawat;
                $cara_masuk_simpan->save();
            }
            $cara_masuk = CaraMasuk::where('nama', $order_lab_cek->jns_rawat)
            ->first();

            //Dokter Pengirim
            $dokter = Dokter::where('nama_dokter', $order_lab_cek->nama_dok_kirim)
            ->where('kode_his', $order_lab_cek->kode_dok_kirim)
            ->first();
            if(!$dokter){
                $dokter_simpan = new Dokter();
                $dokter_simpan->nama_dokter = $order_lab_cek->nama_dok_kirim;
                $dokter_simpan->kode_his = $order_lab_cek->kode_dok_kirim;
                $dokter_simpan->save();
            }
            $dokter = Dokter::where('nama_dokter', $order_lab_cek->nama_dok_kirim)
            ->where('kode_his', $order_lab_cek->kode_dok_kirim)
            ->first();

            $transaksi_lab = TransaksiLab::where('no_order', $order_lab_cek->no_lab)->first();
            if(!$transaksi_lab){
                $birthDate = date('Y-m-d', strtotime($pasien->tgl_lahir));
                $today = Carbon::now();
                if ($birthDate > $today) {
                    $umur_tahun = 0;
                    $umur_bulan = 0;
                    $umur_hari = 0;
                }
                else{
                    $umur_tahun = $today->diff($birthDate)->y;
                    $umur_bulan = $today->diff($birthDate)->m;
                    $umur_hari = $today->diff($birthDate)->d;
                }
                $no_lab = $order_lab_cek->no_lab;
                $ldate = date('ymd', strtotime($order_lab_cek->tgl_order));//Carbon::now()->format('ymd');
                $trx_lab = TransaksiLab::where('kode_transaksi_lab', 'LIKE', $ldate."%")->orderBy('id_transaksi_lab', 'desc')->first();
                if($trx_lab){
                    $kode_transaksi = intval(substr($trx_lab->kode_transaksi_lab, -4));
                    $no_lab = $ldate.tambah_nol_didepan($kode_transaksi+1, 4);
                }else{
                    $no_lab = $ldate.tambah_nol_didepan(1, 4);
                }
                $cito = array();
                $cito['-'] = 0;

                $transaksi_lab_order = new TransaksiLab();
                $transaksi_lab_order->kode_transaksi_lab = $no_lab;
                $transaksi_lab_order->no_order = $order_lab_cek->no_lab;
                $transaksi_lab_order->no_registrasi = $order_lab_cek->no_registrasi;
                $transaksi_lab_order->tgl_order = date_create($order_lab_cek->tgl_order);
                $transaksi_lab_order->waktu_sampel = date_create($order_lab_cek->tgl_order);
                $transaksi_lab_order->id_pasien = $pasien->id_pasien;
                $transaksi_lab_order->umur_tahun = $umur_tahun;
                $transaksi_lab_order->umur_bulan = $umur_bulan;
                $transaksi_lab_order->umur_hari = $umur_hari;
                $transaksi_lab_order->id_status = $asuransi->id_asuransi;
                $transaksi_lab_order->nama_dokter_pengirim = $dokter->nama_dokter;
                $transaksi_lab_order->id_ruangan = $ruangan->id_ruangan;
                $transaksi_lab_order->id_ruangan_awal = $ruangan->id_ruangan;
                $transaksi_lab_order->id_cara_masuk = $cara_masuk->id;
                $transaksi_lab_order->jenis_rawat = $order_lab_cek->jns_rawat;
                $transaksi_lab_order->id_asal = 1;
                $transaksi_lab_order->status = 1;
                $transaksi_lab_order->id_user = 1;
                $transaksi_lab_order->prioritas = $cito[$order_lab_cek->prioritas]??1;
                $transaksi_lab_order->status_prioritas = $cito[$order_lab_cek->prioritas]??1;
                $transaksi_lab_order->id_dokter = $setting->id_dokter_pj;
                $transaksi_lab_order->diagnose = $order_lab_cek->ket_klinis;
                $transaksi_lab_order->save();

                $cito_cek = $cito[$order_lab_cek->prioritas]??1;
                if($cito_cek!=0){
                    $cito_cek = StatusCito::where('id_transaksi_lab', $transaksi_lab_order->id_transaksi_lab)
                    ->first();
                    if(!$cito_cek){
                        $status_cito = new StatusCito();
                        $status_cito->id_transaksi_lab = $transaksi_lab_order->id_transaksi_lab;
                        $status_cito->save();
                    }
                }
            }
            $transaksi_lab = TransaksiLab::where('no_order', $order_lab_cek->no_lab)->first();


            $histori = new Histori();
            $histori->id_transaksi_lab=$transaksi_lab->id_transaksi_lab;
            $histori->id_user = 1;
            $histori->aktivitas="Create!";
            $histori->keterangan="Order Auto dari SIMRS";
            $histori->save();

            $tat_cek = TAT::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)->count();
            if($tat_cek==0){
                $tat = new TAT();
                $tat->id_transaksi_lab=$transaksi_lab->id_transaksi_lab;
                $tat->mulai=1;
                $tat->akhir=0;
                $tat->save();
            }

            $order_details = LISOrder::where('no_lab', $order_lab_cek->no_lab)
            ->where('no_registrasi', $order_lab_cek->no_registrasi)
            ->get();
            foreach ($order_details as $order_detail) {
                $paket_lab = JenisPemeriksaan::where('kode_his', $order_detail->kode_test)->first();
                if($paket_lab){
                    $transaksi_paket_lab = TransaksiPaketLab::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)->where('id_paket_lab', $paket_lab->kode_his)->first();
                    if(!$transaksi_paket_lab){
                        $detail_paket = new TransaksiPaketLab();
                        $detail_paket->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                        $detail_paket->id_paket_lab = $paket_lab->kode_his;
                        $detail_paket->id_harga_kultur = 0;
                        $detail_paket->harga = 0;//$paket_lab->harga;
                        $detail_paket->waktu = $paket_lab->waktu_paket->waktu??0;
                        $detail_paket->cito = $paket_lab->waktu_paket->cito??0;
                        $detail_paket->save();
                    }

                    $pemeriksaan = PaketLab::where('no_jenis', $order_detail->kode_test)->get();
                    foreach ($pemeriksaan as $item) {
                        $pemeriksaan_detail = PaketLabDetail::where('id_paket_lab', $item->id_paket_lab)->get();
                        foreach ($pemeriksaan_detail as $detail) {
                            $kode_lab = KodeLab::find($detail->id_kode_lab);
                            if($kode_lab){
                                $transaksi_detail = TransaksiLabDetail::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)
                                ->where('id_kode_lab', $detail->id_kode_lab)
                                ->first();
                                if(!$transaksi_detail){
                                    $transaksi_lab_detail = new TransaksiLabDetail();
                                    $transaksi_lab_detail->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                                    $transaksi_lab_detail->id_kode_lab = $detail->id_kode_lab;
                                    $transaksi_lab_detail->kode_his = $item->kode_his;
                                    $transaksi_lab_detail->kode_tes = $kode_lab->kode_tes;
                                    $transaksi_lab_detail->save();
                                }
                            }
                        }
                    }
                }
            }
            
            foreach ($order_details as $order_detail) {
                $order_detail->status=1;
                $order_detail->update();
            }
        }
        return response()->json($order_lab_cek, 200);
    }

    public function kirimSIMRS($id)
    {
        $flag = ['N', 'L', 'H', '*'];
        $transaksi_lab = TransaksiLab::find($id);

        if (!$transaksi_lab) {
            return response()->json([
                'status' => 'error',
                'message' => "Transaksi lab dengan ID $transaksi_lab->no_order tidak ditemukan."
            ], 404);
        }

        try {
            // Hapus hasil lama
            LISHasilDetail::where('no_lab', $transaksi_lab->no_order)->delete();

            $details = TransaksiLabDetail::where('id_transaksi_lab', $id)->get();
            $no = 1;

            foreach ($details as $detail) {
                $kode_order_simrs = PaketLab::where('kode_his', $detail->kode_his)->value('no_jenis');

                $kirim_hasil = new LISHasilDetail();
                $kirim_hasil->no_urut          = $no++;
                $kirim_hasil->no_order         = $transaksi_lab->no_order;
                $kirim_hasil->no_lab           = $transaksi_lab->no_order;
                $kirim_hasil->no_registrasi    = $transaksi_lab->no_registrasi;
                $kirim_hasil->kode_pemeriksaan = $detail->kode_his;
                $kirim_hasil->nama_pemeriksaan = $detail->kode_lab->nama;
                $kirim_hasil->unit             = $detail->kode_lab->satuan;
                $kirim_hasil->normal           = $detail->rujukan;
                $kirim_hasil->hasil            = $detail->hasil;
                $kirim_hasil->flag             = $flag[$detail->flag] ?? 'H';
                $kirim_hasil->tgl_jam_insert   = now();
                $kirim_hasil->no_rm            = $transaksi_lab->pasien->kode_rm;
                $kirim_hasil->tgl_daftar       = $transaksi_lab->tgl_order;
                $kirim_hasil->tgl_hasil        = $detail->tgl_hasil;
                $kirim_hasil->kode_test_simrs  = $detail->kode_his;
                $kirim_hasil->kode_order_simrs = $kode_order_simrs;
                $kirim_hasil->save();
            }

            // Update status order lab
            LISOrder::where('no_lab', $transaksi_lab->no_order)
                ->update(['status' => 2]);

            return response()->json([
                'status'   => 'success',
                'message'  => "Hasil lab $transaksi_lab->no_order berhasil dikirim ke SIMRS.",
                'response' => [
                    'no_order'     => $transaksi_lab->no_order,
                    'no_registrasi'=> $transaksi_lab->no_registrasi,
                    'jumlah_detail'=> count($details)
                ]
            ]);
        } catch (\Throwable $e) {
            \Log::error("Gagal kirim SIMRS ID $transaksi_lab->no_order: " . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat mengirim hasil lab ke SIMRS.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
