<?php
namespace App\Services\Rules;
use App\Models\Komisi;
class RulesKomisi implements RulesInterface

{

    protected $rules;


    public function __construct($rules = 'rules_komisi')
    {
        $this->rules = $rules;
    }

    public function getDataRules($id = NULL)
    {

        if($id == NULL ){
            $id_komisi = Komisi::getidactive();

            $data_rules = Komisi::getdatarules($id_komisi,$this->rules);

        }else{

            $id_komisi = $id;

            $data_rules = Komisi::getdatarules($id_komisi,$this->rules);

        }

        return $data_rules;
    }

    public function normalize($id = NULL)
    {   

        if($id == NULL){

            $normalize_rules = $this->getDataRules();

        }else{
            $normalize_rules = $this->getDataRules($id);

        }
       
        
        return json_decode(json_encode($normalize_rules[0]), false);

    }

    public function getDetailRulesById($id)
    {

       return $this->normalize($id);
        
    }

    public function check($data)
    {
        // Lakukan pengecekan aturan periode
        // ...  
        $data_rules = $this->normalize(); 
       
        if($data_rules->rule_periode == 1){
           
            $result = 'valid';

        }else{

            if ($data['periode'] >= $data_rules->periode_mulai && $data['periode'] <= $data_rules->periode_akhir) {
                $result = 'valid';
            } else {
                $result = 'unvalid';
            }

        }
      
        // Contoh implementasi sederhana, jika periode terpenuhi, kembalikan nilai 'passed'
        if ($result == 'valid') {
            return 'passed';
        } else {
            return 'failed';
        }
    }

    
    public function KomisiDetail()
    {

        $data_rules = $this->normalize();

        if($data_rules->opsi_komisi == 1){

            if($data_rules->setting_komisi == 1){
                $setting_komisi = 'Per Faktur';
            }else{
                $setting_komisi = 'Per Kuantitas Barang';
            };
            $data_komisi = [
                'jumlah_komisi'=>$data_rules->rule_komisi,
                'keterangan_komisi'=>$setting_komisi
            ];
            return $data_komisi;

        }elseif($data_rules->opsi_komisi == 2){

            if($data_rules->setting_komisi ==1){
                $setting_komisi = 'Penilaian Penjualan';
            }else{
                $setting_komisi = 'Laba Kotor';
            }
            $data_komisi = [
                'jumlah_komisi'=>$data_rules->rule_komisi,
                'keterangan_komisi'=>$setting_komisi
            ];
            return $data_komisi;

        };

    }
   
}