<?php
namespace App\Services\Rules;


class RulesPemasok implements RulesInterface

{

    protected $rules;

    public function __construct($rules = 'rules_supplier')
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
        $result = 'valid';
        // Contoh implementasi sederhana, jika periode terpenuhi, kembalikan nilai 'passed'
        if ($result === 'valid') {
            return 'passed';
        } else {
            return 'failed';
        }
    }
}