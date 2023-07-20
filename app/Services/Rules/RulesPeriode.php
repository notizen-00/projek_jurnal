<?php
namespace App\Services\Rules;
use App\Models\Komisi;
class RulesPeriode implements RulesInterface

{

    protected $rules;


    public function __construct($rules = 'rules_periode')
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

       $detail = $this->normalize($id);

      if($detail->rule_periode == 1){
        return 'Berlaku Selamanya';
      }else{

        $data = [
            $detail->periode_mulai,
            $detail->periode_akhir
        ];
        return $data;

      }
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
}