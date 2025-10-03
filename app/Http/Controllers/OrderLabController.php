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
        $todayDate = date('Y-m-d');
        $order_lab_cek = LISOrder::orderBy('tgl_order', 'asc')
            ->where('status', 0)
            ->first();
        dd($order_lab_cek);
        if ($lis_order_cek) {
            //Pasien
            $pasien = Pasien::where('kode_rm',  $lis_order_cek->no_rkm_medis)->first();
            if (!$pasien) {
                $jk = array();
                $jk['P'] = 0;
                $jk['L'] = 1;

                $pasien_simpan = new Pasien();
                $pasien_simpan->kode_rm  = $lis_order_cek->no_rkm_medis;
                $pasien_simpan->nama  = $lis_order_cek->nm_pasien;
                $pasien_simpan->tempat_lahir  = $lis_order_cek->tmp_lahir;
                $pasien_simpan->tempat_lahir  = $lis_order_cek->tmp_lahir;
                $pasien_simpan->tgl_lahir  = date_create($lis_order_cek->tgl_lahir);
                $pasien_simpan->jenis_kelamin  = $jk[$lis_order_cek->jk];
                $pasien_simpan->alamat  = $lis_order_cek->alamat;
                $pasien_simpan->email  = $lis_order_cek->email;
                // $pasien_simpan->alamat2  = $lis_order_cek->ADDRESS2;
                // $pasien_simpan->alamat3  = $lis_order_cek->ADDRESS3;
                // $pasien_simpan->alamat4  = $lis_order_cek->ADDRESS4;
                $pasien_simpan->save();
            }
            $pasien = Pasien::where('kode_rm',  $lis_order_cek->no_rkm_medis)->first();

            //Asuransi
            $cek_asuransi = '-';
            $cek_kode_asuransi = '-';
            if ($lis_order_cek->kode_carabayar != null) {
                $cek_kode_asuransi = $lis_order_cek->kode_carabayar;
                $cek_asuransi = $lis_order_cek->nama_carabayar;
            }
            $asuransi = StatusAsuransi::where('nama_asuransi', $cek_asuransi)
                ->where('kode_his', $cek_kode_asuransi)
                ->first();
            if (!$asuransi) {
                $asuransi_simpan = new StatusAsuransi();
                $asuransi_simpan->nama_asuransi = $cek_asuransi;
                $asuransi_simpan->kode_his = $cek_kode_asuransi;
                $asuransi_simpan->save();
            }
            $asuransi = StatusAsuransi::where('nama_asuransi', $cek_asuransi)
                ->where('kode_his', $cek_kode_asuransi)
                ->first();

            //Ruangan
            $cek_nama_ruangan = '-';
            $cek_kode_ruangan = '-';
            if ($lis_order_cek->kode_ruang != null) {
                $cek_nama_ruangan = $lis_order_cek->nama_ruang;
                $cek_kode_ruangan = $lis_order_cek->kode_ruang;
            }
            $ruangan = Ruangan::where('nama_ruangan', $cek_nama_ruangan)
                ->where('kode_his', $cek_kode_ruangan)
                ->first();
            if (!$ruangan) {
                $ruangan_simpan = new Ruangan();
                $ruangan_simpan->nama_ruangan = $cek_nama_ruangan;
                $ruangan_simpan->kode = $cek_kode_ruangan;
                $ruangan_simpan->kode_his = $cek_kode_ruangan;
                $ruangan_simpan->save();
            }
            $ruangan = Ruangan::where('nama_ruangan', $cek_nama_ruangan)
                ->where('kode_his', $cek_kode_ruangan)
                ->first();

            //Dokter Pengirim
            $cek_nama_dokter = '-';
            $cek_kodehis_dokter = '-';
            if ($lis_order_cek->kode_dokter_perujuk != null) {
                $cek_nama_dokter = $lis_order_cek->dokter_perujuk;
                $cek_kodehis_dokter = $lis_order_cek->kode_dokter_perujuk;
            }
            $dokter = Dokter::where('nama_dokter', $cek_nama_dokter)
                ->where('kode_his', $cek_kodehis_dokter)
                ->first();
            if (!$dokter) {
                $dokter_simpan = new Dokter();
                $dokter_simpan->nama_dokter = $cek_nama_dokter;
                $dokter_simpan->kode_his = $cek_kodehis_dokter;
                $dokter_simpan->save();
            }
            $dokter = Dokter::where('nama_dokter', $cek_nama_dokter)
                ->where('kode_his', $cek_kodehis_dokter)
                ->first();

            $instalasi = Instalasi::where('nama', $lis_order_cek->status)
                ->where('kode_his', $lis_order_cek->status)
                ->first();
            if (!$instalasi) {
                $instalasi_simpan = new Instalasi();
                $instalasi_simpan->nama = $lis_order_cek->status;
                $instalasi_simpan->kode_his = $lis_order_cek->status;
                $instalasi_simpan->save();
            }
            $instalasi = Instalasi::where('nama', $lis_order_cek->status)
                ->where('kode_his', $lis_order_cek->status)
                ->first();

            $transaksi_lab = TransaksiLab::where('no_order', $lis_order_cek->noorder)->first();
            if (!$transaksi_lab) {
                $birthDate = date('Y-m-d', strtotime($pasien->tgl_lahir));
                $today = Carbon::now();
                if ($birthDate > $today) {
                    $umur_tahun = 0;
                    $umur_bulan = 0;
                    $umur_hari = 0;
                } else {
                    $umur_tahun = $today->diff($birthDate)->y;
                    $umur_bulan = $today->diff($birthDate)->m;
                    $umur_hari = $today->diff($birthDate)->d;
                }
                $no_lab = $lis_order_cek->noorder;
                $ldate = date('ymd', strtotime($lis_order_cek->tgl_permintaan)); //Carbon::now()->format('ymd', $lis_order_cek->tgl_permintaan);//
                $trx_lab = TransaksiLab::where('kode_transaksi_lab', 'LIKE', $ldate . "%")->orderBy('id_transaksi_lab', 'desc')->first();
                if ($trx_lab) {
                    $kode_transaksi = intval(substr($trx_lab->kode_transaksi_lab, -4));
                    $no_lab = $ldate . tambah_nol_didepan($kode_transaksi + 1, 4);
                } else {
                    $no_lab = $ldate . tambah_nol_didepan(1, 4);
                }
                $cito = array();
                $cito['R'] = 0;
                $cito['U'] = 1;

                $transaksi_lab_order = new TransaksiLab();
                $transaksi_lab_order->kode_transaksi_lab = $no_lab;
                $transaksi_lab_order->no_order = $lis_order_cek->noorder;
                $transaksi_lab_order->no_registrasi = $lis_order_cek->no_rawat;
                $transaksi_lab_order->tgl_order = date_create($lis_order_cek->tgl_permintaan . ' ' . $lis_order_cek->jam_permintaan);
                $transaksi_lab_order->waktu_sampel = date_create($lis_order_cek->tgl_permintaan . ' ' . $lis_order_cek->jam_permintaan);
                $transaksi_lab_order->id_pasien = $pasien->id_pasien;
                $transaksi_lab_order->umur_tahun = $umur_tahun;
                $transaksi_lab_order->umur_bulan = $umur_bulan;
                $transaksi_lab_order->umur_hari = $umur_hari;
                $transaksi_lab_order->id_status = $asuransi->id_asuransi;
                $transaksi_lab_order->nama_dokter_pengirim = $dokter->nama_dokter;
                $transaksi_lab_order->id_ruangan = $ruangan->id_ruangan;
                $transaksi_lab_order->id_ruangan_awal = $ruangan->id_ruangan;
                $transaksi_lab_order->status = 1;
                $transaksi_lab_order->id_user = 1;
                $transaksi_lab_order->id_cara_masuk = NULL;
                $transaksi_lab_order->jenis_rawat = '-';

                // $transaksi_lab_order->prioritas = $cito[$lis_order_cek->priority]??1;
                // $transaksi_lab_order->status_prioritas = $cito[$lis_order_cek->priority]??1;
                $transaksi_lab_order->id_dokter = $setting->id_dokter_pj;
                // $transaksi_lab_order->id_kelas = $kelas->id;
                $transaksi_lab_order->id_instalasi = $instalasi->id;
                $transaksi_lab_order->diagnose = $lis_order_cek->diagnosa_klinis;
                $transaksi_lab_order->catatan = $lis_order_cek->informasi_tambahan;
                // $transaksi_lab_order->is_mcu = $item_order->is_mcu;
                $transaksi_lab_order->save();
            }

            $transaksi_lab = TransaksiLab::where('no_order', $lis_order_cek->noorder)->first();
            if ($transaksi_lab) {
                $order_detail = LISOrderDetail::where('noorder', $lis_order_cek->noorder)->get();
                foreach ($order_detail as $item) {
                    $paket_lab = JenisPemeriksaan::where('kode_his', $item->kd_jenis_prw)->first();
                    if ($paket_lab) {
                        $transaksi_paket_lab = TransaksiPaketLab::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)->where('id_paket_lab', $paket_lab->kode_his)->first();
                        if (!$transaksi_paket_lab) {
                            $detail_paket = new TransaksiPaketLab();
                            $detail_paket->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                            $detail_paket->id_paket_lab = $paket_lab->kode_his;
                            $detail_paket->id_harga_kultur = 0;
                            $detail_paket->harga = 0; //$paket_lab->harga;
                            $detail_paket->waktu = $paket_lab->waktu_paket->waktu ?? 0;
                            $detail_paket->cito = $paket_lab->waktu_paket->cito ?? 0;
                            $detail_paket->save();
                        }
                        $pemeriksaans = PaketLab::where('no_jenis', $item->kd_jenis_prw)
                            ->where('kode_his', $item->id_template)
                            ->get();
                        foreach ($pemeriksaans as $pemeriksaan) {
                            $pemeriksaan_detail = PaketLabDetail::where('id_paket_lab', $pemeriksaan->id_paket_lab)->get();
                            foreach ($pemeriksaan_detail as $detail) {
                                $kode_lab = KodeLab::find($detail->id_kode_lab);
                                if ($kode_lab) {
                                    $transaksi_detail = TransaksiLabDetail::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)
                                        ->where('id_kode_lab', $detail->id_kode_lab)
                                        ->first();
                                    if (!$transaksi_detail) {
                                        $transaksi_lab_detail = new TransaksiLabDetail();
                                        $transaksi_lab_detail->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                                        $transaksi_lab_detail->id_kode_lab = $detail->id_kode_lab;
                                        $transaksi_lab_detail->kode_his = $item->id_template;
                                        $transaksi_lab_detail->kode_tes = $kode_lab->kode_tes;
                                        $transaksi_lab_detail->save();
                                    }
                                }
                            }
                        }
                    }
                }
                // $cito_cek = $cito[$lis_order_cek->priority]??1;
                // if($cito_cek!=0){
                //     $cito_cek = StatusCito::where('id_transaksi_lab', $transaksi_lab->id_transaksi_lab)
                //     ->first();
                //     if(!$cito_cek){
                //         $status_cito = new StatusCito();
                //         $status_cito->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                //         $status_cito->save();
                //     }
                // }

                $oder_alat_kimia = OrderAlatKimia::where('kode_transaksi_lab', $transaksi_lab->kode_transaksi_lab)->first();
                if (!$oder_alat_kimia) {
                    $alat_kimia = new OrderAlatKimia();
                    $alat_kimia->kode_transaksi_lab = $transaksi_lab->kode_transaksi_lab;
                    $alat_kimia->save();
                }

                $histori = new Histori();
                $histori->id_transaksi_lab = $transaksi_lab->id_transaksi_lab;
                $histori->id_user = 1;
                $histori->aktivitas = "Order!";
                $histori->keterangan = "Order Auto dari SIMRS";
                $histori->save();
            }

            $lis_order_cek->status_ambil = '1';
            $lis_order_cek->update();
        }
        return response()->json($lis_order_cek, 200);
    }

    public function kirimSIMRS($id)
    {
        // dd($id);
        $flag = array();
        $flag[0] = '';
        $flag[1] = '*';
        $flag[2] = '*';
        $flag_ket = array();
        $flag_ket[0] = '';
        $flag_ket[1] = 'L';
        $flag_ket[2] = 'H';

        $transaksi_lab = TransaksiLab::find($id);
        if($transaksi_lab){
            $lis_hasil = LISHasilDetail::where('noorder', $transaksi_lab->no_order)
            ->get();
            foreach ($lis_hasil as $item) {
                $item->delete();
            }


            $detail_gdt = TransaksiLabGDT::where('id_transaksi_lab', $id)->first();
            if($detail_gdt){
                $details = TransaksiLabDetail::where('id_transaksi_lab', $id)
                // ->where('validasi', 1)
                // ->where('cek_print', 1)
                ->orderBy('kode_tes')
                ->get();
                $no = 1;
                foreach ($details as $detail) {
                    $paket_lab = PaketLab::where('kode_his', $detail->kode_his)->first();
                    if($paket_lab){
                        $hasil = $detail->hasil;
                        if(is_numeric($hasil)){
                            if($hasil>999){
                                $hasil = format_uang($hasil, 0);
                            }
                        }
                        $rujukan = $detail->rujukan;
                        if(strlen($rujukan)<=0){
                            $rujukan='-';
                        }
                        if($detail->kode_lab->kd_lis=='eriGDT'){
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $detail_gdt->eritrosit;
                            $lis_hasil_store->nilai_rujukan = $rujukan;
                            $lis_hasil_store->keterangan = '-';
                            $lis_hasil_store->save();
                        }
                        else if($detail->kode_lab->kd_lis=='leuGDT'){
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $detail_gdt->lekosit;
                            $lis_hasil_store->nilai_rujukan = $rujukan;
                            $lis_hasil_store->keterangan = '-';
                            $lis_hasil_store->save();
                        }
                        else if($detail->kode_lab->kd_lis=='pltGDT'){
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $detail_gdt->trombosit;
                            $lis_hasil_store->nilai_rujukan = $rujukan;
                            $lis_hasil_store->keterangan = '-';
                            $lis_hasil_store->save();
                        }
                        else if($detail->kode_lab->kd_lis=='kesGDT'){
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $detail_gdt->kesan;
                            $lis_hasil_store->nilai_rujukan = $rujukan;
                            $lis_hasil_store->keterangan = '-';
                            $lis_hasil_store->save();
                        }
                        else if($detail->kode_lab->kd_lis=='sarGDT'){
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $detail_gdt->saran;
                            $lis_hasil_store->nilai_rujukan = $rujukan;
                            $lis_hasil_store->keterangan = '-';
                            $lis_hasil_store->save();
                        }
                        else{
                            $ket_kritis = '';
                            if($detail->kritis!=0){
                                $ket_kritis = 'T';
                            }
                            else{
                                $ket_kritis = $flag_ket[$detail->flag]??'H';
                            }
                            $lis_hasil_store = new LISHasilDetail();
                            $lis_hasil_store->noorder = $transaksi_lab->no_order;
                            $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                            $lis_hasil_store->id_template = $detail->kode_his;
                            $lis_hasil_store->nilai = $hasil;//.($flag[$detail->flag]??'*');//$detail->hasil;
                            $lis_hasil_store->nilai_rujukan = $rujukan;//$detail->rujukan;
                            $lis_hasil_store->keterangan = $ket_kritis;//$flag_ket[$detail->kirits]??'H';//$detail->kode_lab->keterangan??'';//$flag[$detail->flag]??'*';
                            $lis_hasil_store->save();
                        }
                    }
                }
            }
            else{
                
                $details = TransaksiLabDetail::where('id_transaksi_lab', $id)
                ->where('validasi', 1)
                ->where('cek_print', 1)
                ->orderBy('kode_tes')
                ->get();
                
                $no = 1;
                foreach ($details as $detail) {
                    $ket_kritis = '';
                    if($detail->kritis!=0){
                        $ket_kritis = 'T';
                    }
                    else{
                        $ket_kritis = $flag_ket[$detail->flag]??'H';
                    }
                    $paket_lab = PaketLab::where('kode_his', $detail->kode_his)->first();
                    if($paket_lab){
                        $hasil = $detail->hasil;
                        if(is_numeric($hasil)){
                            if($hasil>999){
                                $hasil = format_uang($hasil, 0);
                            }
                        }
                        $rujukan = $detail->rujukan;
                        if(strlen($rujukan)<=0){
                            $rujukan='-';
                        }
                        $lis_hasil_store = new LISHasilDetail();
                        $lis_hasil_store->noorder = $transaksi_lab->no_order;
                        $lis_hasil_store->kd_jenis_prw = $paket_lab->no_jenis;
                        $lis_hasil_store->id_template = $detail->kode_his;
                        $lis_hasil_store->nilai = $hasil;//.($flag[$detail->flag]??'*');//$detail->hasil;
                        $lis_hasil_store->nilai_rujukan = $rujukan;//$detail->rujukan;
                        $lis_hasil_store->keterangan = $ket_kritis;//$flag_ket[$detail->kritis]??'H';//$detail->kode_lab->keterangan??'';//$flag[$detail->flag]??'*';
                        $lis_hasil_store->save();
                        // dd($lis_hasil_store);
                    }
                }
                
            }
                  
        } 

        
    }
  
      


}
