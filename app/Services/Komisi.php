<?php
namespace App\Services;

use App\Services\Rules\RuleInterface;
class Komisi
{
    protected $RulesPeriode;
    protected $RulesBarang;
    protected $RulesPemasok;

    public function __construct(
        RuleInterface $RulesPeriode,
        RuleInterface $RulesBarang,
        RuleInterface $RulesPemasok
    ) {
        $this->RulesPeriode = $RulesPeriode;
        $this->RulesBarang = $RulesBarang;
        $this->RulesPemasok = $RulesPemasok;
    }

    public function checkKomisi($data )
    {
        // Lakukan pengecekan berdasarkan masing-masing aturan (rules)
        $periodeResult = $this->RulesPeriode->check($data);
        $barangTertentuResult = $this->RulesBarang->check($data);
        $pemasokTertentuResult = $this->RulesPeriode->check($data);

        // Lakukan pengecekan tambahan atau logika bisnis lainnya

        // Contoh logika sederhana, jika semua aturan terpenuhi, komisi dinyatakan valid
        if ($periodeResult === 'passed' && $barangTertentuResult === 'passed' && $pemasokTertentuResult === 'passed') {
            return 'passed';
        } else {
            return 'failed';
        }
    }
}

?>