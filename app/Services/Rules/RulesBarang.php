<?php
namespace App\Services\Rules;
use App\Models\Komisi;

class RulesBarang implements RulesInterface

{

    protected $rules;

    public function __construct($rules = 'rules_barang')
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
        $data_rules = $this->normalize();
        $data_array = json_decode(json_encode($data_rules), true);

        $request_barang = $data['barang']; 

        if($data_rules->rule_barang == 1){
            $result = 'valid';
        }else{

            $result = 'unvalid';

            foreach ($request_barang as $value) {
                if (in_array($value, $data_array)) {
                    $result = 'valid';
                    break;
                }
            }
            // if(in_array($request_barang,$data_array)){
            //     $result = 'valid';
            // }else{
            //     $result = 'unvalid';
            // }
            
        }
        // Lakukan pengecekan aturan periode
        // ...
        
        // Contoh implementasi sederhana, jika periode terpenuhi, kembalikan nilai 'passed'
        if ($result === 'valid') {
            return 'passed';
        } else {
            return 'failed';
        }
    }

   

    
}
