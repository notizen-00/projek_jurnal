<?php
namespace App\Services\Rules;

interface RulesInterface
{
    public function check($data);

    public function getDataRules();

    public function normalize();

    public function getDetailRulesById($id);

} 