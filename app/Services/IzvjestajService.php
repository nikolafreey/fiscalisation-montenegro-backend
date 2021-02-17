<?php

namespace App\Services;

class IzvjestajService
{
    private $poslovnaJedinica;
    private $tip;
    private $pocetakDana;
    private $krajDana;

    public function __construct($poslovnaJedinica, $tip, $pocetakDana = null, $krajDana = null)
    {
        $this->poslovnaJedinica = $poslovnaJedinica;
        $this->tip = $tip;
        $this->pocetakDana = $pocetakDana;
        $this->krajDana = $krajDana;
    }

    public function getPoreskiObveznikInformacije()
    {
        return [
            'naziv_poreskog_obveznika' => $this->poslovnaJedinica->preduzece->kratki_naziv,
            'sjediste_poreskog_obveznika' => $this->poslovnaJedinica->preduzece->grad . ', ' . $this->poslovnaJedinica->preduzece->adresa,
            'pib' => $this->poslovnaJedinica->preduzece->pib,
            'naziv_objekta' => $this->poslovnaJedinica->kratki_naziv,
            'adresa_objekta' => $this->poslovnaJedinica->grad . ', ' . $this->poslovnaJedinica->adresa,
            'enu_kod' => 'ys396zg231',

            'tip_dokumenta_izvjestaja' => $this->tip,

            'od' =>  $this->pocetakDana,
            'do' => $this->krajDana,
        ];
    }

    public function getKalkulacije()
    {
        $racuni = $this->poslovnaJedinica
            ->racuni
            ->whereBetween('created_at', [$this->pocetakDana, $this->krajDana]);

        $ukupanPromet = 0;
        $zbir_osnovica_21 = 0;
        $zbir_osnovica_7 = 0;
        $zbir_osnovica_0 = 0;
        $zbir_poreza_21 = 0;
        $zbir_poreza_7 = 0;
        $zbir_poreza_0 = 0;
        $zbir_prometa_po_stopi_21 = 0;
        $zbir_prometa_po_stopi_7 = 0;
        $zbir_prometa_po_stopi_0 = 0;
        $oslobodjeniPromet = 0;

        foreach($racuni as $racun) {
            foreach($racun->stavke as $stavka) {

                if ($stavka->porez_id === 4) {
                    $zbir_osnovica_21 += $stavka->cijena_bez_pdv;
                    $zbir_poreza_21 += $stavka->pdv_iznos;
                    $zbir_prometa_po_stopi_21 += $stavka->cijena_sa_pdv;
                }

                if ($stavka->porez_id === 3) {
                    $zbir_osnovica_7 += $stavka->cijena_bez_pdv;
                    $zbir_poreza_7 += $stavka->pdv_iznos;
                    $zbir_prometa_po_stopi_7 += $stavka->cijena_sa_pdv;
                }

                if ($stavka->porez_id === 2) {
                    $zbir_osnovica_0 += $stavka->cijena_bez_pdv;
                    $zbir_prometa_po_stopi_0 += $stavka->cijena_bez_pdv;
                }

                if ($stavka->porez_id === 1) {
                    $oslobodjeniPromet += $stavka->cijena_bez_pdv;
                }
            }
        }

        $ukupnoOsnovicaPoStopama = $zbir_osnovica_21 + $zbir_osnovica_7 + $zbir_osnovica_0;

        $ukupanPorezPoStopama = $zbir_poreza_21 + $zbir_poreza_7 + $zbir_poreza_0;

        $ukupanPromet = $zbir_prometa_po_stopi_21 + $zbir_prometa_po_stopi_7 + $zbir_prometa_po_stopi_0 + $oslobodjeniPromet;

        $korektivniRacuni = $racuni->where('korektivni_racun', true);

        $brojKorektivnihRacuna = $korektivniRacuni->count();
        $ukupanPrometKorektivnihRacuna = 0;
        $ukupanPorezKorektivnihRacuna = 0;

        foreach ($korektivniRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometKorektivnihRacuna += $stavka->cijena_bez_pdv;
                $ukupanPorezKorektivnihRacuna += $stavka->pdv_iznos;
            }
        }

        $gotovinskiRacuni = $racuni->where('vrsta_racuna', 'GOTOVINSKI');
        $bezgotovinskiRacuni = $racuni->where('vrsta_racuna', 'BEZGOTOVINSKI');

        $ukupanPrometGotovinskihRacuna = 0;
        $ukupanPrometBezgotovinskihRacuna = 0;

        $ukupanPrometGotovinskihBanknoteRacuna = 0;
        $ukupanPrometGotovinskihCardRacuna = 0;
        $ukupanPrometGotovinskihOrderRacuna = 0;
        $ukupanPrometGotovinskihOthercashRacuna = 0;

        foreach ($gotovinskiRacuni as $racun) {
            if($racun->nacin_placanja === 'BANKNOTE') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihBanknoteRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'CARD') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihCardRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOrderRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'OTHER-CASH') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOthercashRacuna += $stavka->cijena_bez_pdv;
                }
            }
        }

        $ukupanPrometBezgotovinskihBusinesscardRacuna = 0;
        $ukupanPrometBezgotovinskihSvoucherRacuna = 0;
        $ukupanPrometBezgotovinskihCompanyRacuna = 0;
        $ukupanPrometBezgotovinskihOrderRacuna = 0;
        $ukupanPrometBezgotovinskihAdvanceRacuna = 0;
        $ukupanPrometBezgotovinskihAccountRacuna = 0;
        $ukupanPrometBezgotovinskihFactoringRacuna = 0;
        $ukupanPrometBezgotovinskihOtherRacuna = 0;

        foreach ($bezgotovinskiRacuni as $racun) {
            if($racun->nacin_placanja === 'BUSINESSCARD') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihBusinesscardRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'SVOUCHER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihSvoucherRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'COMPANY') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihCompanyRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOrderRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'ADVANCE') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihAdvanceRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'FACTORING') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihFactoringRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOrderRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'OTHER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOtherRacuna += $stavka->cijena_bez_pdv;
                }
            }
        }


        foreach ($bezgotovinskiRacuni as $racun) {
            if($racun->nacin_placanja === 'BUSINES') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihBusinesscardRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'CARD') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihCardRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOrderRacuna += $stavka->cijena_bez_pdv;
                }
            }

            if($racun->nacin_placanja === 'OTHER-CASH') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOthercashRacuna += $stavka->cijena_bez_pdv;
                }
            }

        }


        foreach ($gotovinskiRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometGotovinskihRacuna += $stavka->cijena_bez_pdv;
            }
        }



        foreach ($bezgotovinskiRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometBezgotovinskihRacuna += $stavka->cijena_bez_pdv;
            }
        }

        $offlineRacuni = $racuni->where('offline', true);

        $ukupanBrojOfflineRacuna = $offlineRacuni->count();
        $ukupanPrometOfflineRacuna = 0;
        $ukupanPorezOfflineRacuna = 0;

        foreach ($offlineRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometOfflineRacuna += $stavka->cijena_bez_pdv;
                $ukupanPorezOfflineRacuna += $stavka->pdv_iznos;
            }
        }


        return [
            'broj_promjena_poreza' => '',

            'poreska_stopa_21' => [
                'osnovica_21' => $zbir_osnovica_21,
                'iznos_poreza_21' => $zbir_poreza_21,
                'promet_po_stopi_21' => $zbir_prometa_po_stopi_21
            ],

            'poreska_stopa_7' => [
                'osnovica_7' => $zbir_osnovica_7,
                'iznos_poreza_7' => $zbir_poreza_7,
                'promet_po_stopi_7' => $zbir_prometa_po_stopi_7
            ],

            'poreska_stopa_0' => [
                'osnovica_0' => $zbir_osnovica_0,
                'iznos_poreza_0' => $zbir_poreza_0,
                'promet_po_stopi_0' => $zbir_prometa_po_stopi_0
            ],

            'oslobodjeni_promet' => $oslobodjeniPromet,

            'ukupno' => [
                'ukupno_osnovica_po_stopama_21_7_0' =>  $ukupnoOsnovicaPoStopama,
                'ukupno_porez_po_stopama_21_7_0' =>  $ukupanPorezPoStopama,
                'ukupan_promet' =>  $ukupanPromet
            ],

            'racuni_sa_korekcijom' => [
                'ukupan_broj_racuna' => $brojKorektivnihRacuna,
                'ukupan_promet' => $ukupanPrometKorektivnihRacuna,
                'ukupan_porez' => $ukupanPorezKorektivnihRacuna
            ],

            'racuni_u_offline_rezimu' => [
                'ukupan_broj_racuna' => $ukupanBrojOfflineRacuna,
                'ukupan_promet' => $ukupanPrometOfflineRacuna,
                'ukupan_porez' => $ukupanPorezOfflineRacuna
            ],

            'racuni_order' => [
                'ukupan_broj_racuna' => '',
                'ukupan_promet' => '',
                'ukupan_porez' => ''
            ],

            'promet_evidentiran_u_gotovini' => [
                'banknote' => $ukupanPrometGotovinskihBanknoteRacuna,
                'card' => $ukupanPrometGotovinskihCardRacuna,
                'order' => $ukupanPrometGotovinskihOrderRacuna,
                'other_cash' => $ukupanPrometGotovinskihOthercashRacuna
            ],

            'promet_evidentiran_u_bezgotovini' => [
                'business_card' => $ukupanPrometBezgotovinskihBusinesscardRacuna,
                'svoucher' =>  $ukupanPrometBezgotovinskihSvoucherRacuna,
                'company' => $ukupanPrometBezgotovinskihCompanyRacuna,
                'order' => $ukupanPrometBezgotovinskihOrderRacuna,
                'advance' => $ukupanPrometBezgotovinskihAdvanceRacuna,
                'account' => $ukupanPrometBezgotovinskihAccountRacuna,
                'factoring' => $ukupanPrometBezgotovinskihFactoringRacuna,
                'other' => $ukupanPrometBezgotovinskihOtherRacuna
            ],

            'withdraw' => '',

            'inicijalni_gotovinski_depozit' => '',
            'ukupan_promet' => $ukupanPromet,
            'non_cash_promet' => $ukupanPrometBezgotovinskihRacuna,
            'card_i_order_promet' => $ukupanPrometGotovinskihRacuna,
            'ukupno_withdraw' => '',
            'gotovina_u_enu' => '',

            'datum_dokumenta' => date('d-m-Y'),
            'vrijeme_dokumenta' => date('H:i:s'),
            'operater' => '',

            'racuni' => $racuni->map->only('kod_operatera', 'broj_racuna', 'jikr', 'ikof', 'qr')->toArray()

        ];
    }
}