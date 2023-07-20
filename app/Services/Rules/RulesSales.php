<?php
namespace App\Services\Rules;
use App\Models\Komisi;
class RulesSales implements RulesInterface

{

    protected $rules;


    public function __construct($rules = 'rules_sales')
    {
        $this->rules = $rules;
    }

    public function getDataRules()
    {

        $id_komisi = Komisi::getidactive();

        $data_rules = Komisi::getdatarules($id_komisi,$this->rules);

        return $data_rules;
    }

    public function normalize()
    {   
        $normalize_rules = $this->getDataRules();
        
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
       $data_array = json_decode(json_encode($data_rules), true);
    
       $request_sales = $data['sales'];

       if($data_rules->rule_sales == 1)
       {

        $result = 'valid';
       }else{
            
            if(in_array($request_sales,$data_array)){
                $result = 'valid';
            }else{
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
