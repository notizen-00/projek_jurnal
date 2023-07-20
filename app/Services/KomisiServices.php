<?php
namespace App\Services;

use App\Services\Rules\RulesInterface;
use App\Services\Rules\RulesPeriode;
use App\Services\Rules\RulesBarang;
use App\Models\Komisi;
 
class KomisiServices
{
    protected $RulesPeriode;
    protected $RulesBarang;
    protected $RulesKomisi;
    protected $RulesSales;

    public function __construct(
        RulesInterface $RulesPeriode,
        RulesInterface $RulesBarang,
      
        RulesInterface $RulesKomisi,
        RulesInterface $RulesSales
    ) {
        $this->RulesPeriode = $RulesPeriode;
        $this->RulesBarang = $RulesBarang;
 
        $this->RulesKomisi = $RulesKomisi;
        $this->RulesSales = $RulesSales;
    }

    public function getDataDetail($id)
    {

   
        $data['periode'] = $this->RulesPeriode->getDetailRulesById($id);
        $data['barang'] = $this->RulesBarang->getDetailRulesById($id);
      
        $data['sales'] = $this->RulesSales->getDetailRulesById($id);
        $data['komisi'] = $this->RulesKomisi->getDetailRulesById($id);
        return $data;

    }
    public function getDetailKomisi()
    {
        $data = $this->RulesKomisi->KomisiDetail();

        return \Helper::rupiah($data['jumlah_komisi']) ."--".$data['keterangan_komisi'];

    }
    public function checkKomisi($data)
    {
        // Lakukan pengecekan berdasarkan masing-masing aturan (rules)
        $periodeResult = $this->RulesPeriode->check($data);
        $barangTertentuResult = $this->RulesBarang->check($data);
        $salesTertentuResult = $this->RulesSales->check($data);


        // if($periodeResult === 'passed')
        // {
        //     echo "Periode Passed<br>";
        // }else{
        //     echo "Periode Tidak Lolos <br>";
        // }

        // if($barangTertentuResult === 'passed')
        // {
        //      echo "barang Passed <br>";
        // }else{

        //     echo "Periode Tidak Lolos <br>";
        // }

        // if($pemasokTertentuResult === 'passed')
        // {
        //     echo "pemasok Passed <br>";
        // }else{
        //     echo "Pemasok TIdak Lolos <br>";
        // }
        // Lakukan pengecekan tambahan atau logika bisnis lainnya

        // Contoh logika sederhana, jika semua aturan terpenuhi, komisi dinyatakan valid
        if ($periodeResult === 'passed' && $salesTertentuResult === 'passed' && $barangTertentuResult === 'passed') {
    
            return $this->getDetailKomisi();
        } else {
            return 0;
        }
    }
}

?>