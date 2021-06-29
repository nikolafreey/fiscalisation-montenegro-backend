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
            'enu_kod' => $this->poslovnaJedinica->preduzece->enu_kod,

            'tip_dokumenta_izvjestaja' => $this->tip,

            'od' =>  $this->pocetakDana,
            'do' => $this->krajDana,
        ];
    }

    public function getKalkulacije($tipRacuna = null)
    {
        $racuni = $this->poslovnaJedinica
            ->racuni()
            ->where('status', '!=', 'korektivni')
            ->when($tipRacuna, function ($q) use ($tipRacuna) {
                if ($tipRacuna === 'offline') {
                    return $q->where('offline', true);
                }

                if ($tipRacuna === 'korektivni_racun') {
                    return $q->where('status', 'storniran');
                }
            })
            ->whereBetween('created_at', [$this->pocetakDana, $this->krajDana])
            ->get();

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
                    $zbir_osnovica_21 += $stavka->ukupna_bez_pdv_popust;
                    $zbir_poreza_21 += $stavka->pdv_iznos_ukupno;
                    $zbir_prometa_po_stopi_21 += $stavka->ukupna_sa_pdv_popust;
                }

                if ($stavka->porez_id === 3) {
                    $zbir_osnovica_7 += $stavka->ukupna_bez_pdv_popust;
                    $zbir_poreza_7 += $stavka->pdv_iznos_ukupno;
                    $zbir_prometa_po_stopi_7 += $stavka->ukupna_sa_pdv_popust;
                }

                if ($stavka->porez_id === 2) {
                    $zbir_osnovica_0 += $stavka->ukupna_bez_pdv_popust;
                    $zbir_prometa_po_stopi_0 += $stavka->ukupna_bez_pdv_popust;
                }

                if ($stavka->porez_id === 1) {
                    $oslobodjeniPromet += $stavka->ukupna_bez_pdv_popust;
                }
            }
        }

        $ukupnoOsnovicaPoStopama = $zbir_osnovica_21 + $zbir_osnovica_7 + $zbir_osnovica_0;

        $ukupanPorezPoStopama = $zbir_poreza_21 + $zbir_poreza_7 + $zbir_poreza_0;

        $ukupanPromet = $zbir_prometa_po_stopi_21 + $zbir_prometa_po_stopi_7 + $zbir_prometa_po_stopi_0 + $oslobodjeniPromet;


        $korektivniRacuni = $racuni->where('status', 'storniran');

        $brojKorektivnihRacuna = $korektivniRacuni->count();
        $ukupanPrometKorektivnihRacuna = $korektivniRacuni->sum('ukupna_bez_pdv_popust');
        $ukupanPorezKorektivnihRacuna = $korektivniRacuni->sum('pdv_iznos_ukupno');

        $gotovinskiRacuni = $racuni->where('vrsta_racuna', 'gotovinski');
        $bezgotovinskiRacuni = $racuni->where('vrsta_racuna', 'bezgotovinski');

        $ukupanPrometGotovinskihRacuna = 0;
        $ukupanPrometBezgotovinskihRacuna = 0;

        $ukupanPrometGotovinskihBanknoteRacuna = 0;
        $ukupanPrometGotovinskihCardRacuna = 0;
        $ukupanPrometGotovinskihOrderRacuna = 0;
        $ukupanPrometGotovinskihOthercashRacuna = 0;

        foreach ($gotovinskiRacuni as $racun) {
            if($racun->nacin_placanja === 'BANKNOTE') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihBanknoteRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'CARD') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihCardRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOrderRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'OTHER-CASH') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOthercashRacuna += $stavka->ukupna_bez_pdv_popust;
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
                    $ukupanPrometBezgotovinskihBusinesscardRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'SVOUCHER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihSvoucherRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'COMPANY') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihCompanyRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOrderRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'ADVANCE') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihAdvanceRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'FACTORING') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihFactoringRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOrderRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'OTHER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihOtherRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }
        }

        foreach ($bezgotovinskiRacuni as $racun) {
            if($racun->nacin_placanja === 'BUSINES') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometBezgotovinskihBusinesscardRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'CARD') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihCardRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'ORDER') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOrderRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }

            if($racun->nacin_placanja === 'OTHER-CASH') {
                foreach($racun->stavke as $stavka){
                    $ukupanPrometGotovinskihOthercashRacuna += $stavka->ukupna_bez_pdv_popust;
                }
            }
        }

        foreach ($gotovinskiRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometGotovinskihRacuna += $stavka->ukupna_bez_pdv_popust;
            }
        }

        foreach ($bezgotovinskiRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometBezgotovinskihRacuna += $stavka->ukupna_bez_pdv_popust;
            }
        }


        $offlineRacuni = $racuni->where('offline', true);

        $ukupanBrojOfflineRacuna = $offlineRacuni->count();
        $ukupanPrometOfflineRacuna = 0;
        $ukupanPorezOfflineRacuna = 0;

        foreach ($offlineRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometOfflineRacuna += $stavka->ukupna_bez_pdv_popust;
                $ukupanPorezOfflineRacuna += $stavka->pdv_iznos_ukupno;
            }
        }


        $orderRacuni = $racuni->where('order', true);

        $ukupanBrojOrderRacuna = $orderRacuni->count();
        $ukupanPrometOrderRacuna = 0;
        $ukupanPorezOrderRacuna = 0;

        foreach ($orderRacuni as $racun) {
            foreach($racun->stavke as $stavka){
                $ukupanPrometOrderRacuna += $stavka->ukupna_bez_pdv_popust;
                $ukupanPorezOrderRacuna += $stavka->pdv_iznos_ukupno;
            }
        }


        $ukupanDepozit = 0;
        $ukupanWithdraw = 0;
        foreach($this->poslovnaJedinica->depozitWithdraw as $depozitWithdraw){
            $ukupanDepozit += $depozitWithdraw->iznos_depozit;
            $ukupanWithdraw += $depozitWithdraw->iznos_withdraw;
        }

        if ($this->tip === 'PERIODIČNI FISKALNI IZVJEŠTAJ') {
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

                'fiskalni_racuni' => [
                    'od' => $racuni->first()->redni_broj,
                    'do' => $racuni->sortByDesc('created_at')->first()->redni_broj,
                ],
                'fiskalni_dani' => [
                    'od' => $this->pocetakDana,
                    'do' => $this->krajDana,
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
                    'ukupan_broj_racuna' => $ukupanBrojOrderRacuna,
                    'ukupan_promet' => $ukupanPrometOrderRacuna,
                    'ukupan_porez' => $ukupanPorezOrderRacuna
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

                'withdraw' => $this->poslovnaJedinica->depozitWithdraw()->whereNull('iznos_depozit')->get()->map->only('id', 'iznos_withdraw')->toArray(),

                'inicijalni_gotovinski_depozit' => $ukupanDepozit,
                'ukupan_promet' => $ukupanPromet,
                'non_cash_promet' => $ukupanPrometBezgotovinskihRacuna,
                'card_i_order_promet' => $ukupanPrometGotovinskihRacuna,
                'ukupno_withdraw' => $ukupanWithdraw,
                'gotovina_u_enu' => $ukupanDepozit + $ukupanPrometGotovinskihRacuna,

                'racuni_kod' => $racuni->where('status', '!=', 'storniran')->map->only('kod_operatera', 'broj_racuna', 'jikr', 'ikof', 'qr_url', 'qr_code')->toArray()
            ];
        }

        if ($this->tip === 'FISKALNI DNEVNI IZVJEŠTAJ – KRAJ DANA') {
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
                    'ukupan_broj_racuna' => $ukupanBrojOrderRacuna,
                    'ukupan_promet' => $ukupanPrometOrderRacuna,
                    'ukupan_porez' => $ukupanPorezOrderRacuna
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

                'withdraw' => $this->poslovnaJedinica->depozitWithdraw()->whereNull('iznos_depozit')->get()->map->only('id', 'iznos_withdraw')->toArray(),

                'inicijalni_gotovinski_depozit' => $ukupanDepozit,
                'ukupan_promet' => $ukupanPromet,
                'non_cash_promet' => $ukupanPrometBezgotovinskihRacuna,
                'card_i_order_promet' => $ukupanPrometGotovinskihRacuna,
                'ukupno_withdraw' => $ukupanWithdraw,
                'gotovina_u_enu' => $ukupanDepozit + $ukupanPrometGotovinskihRacuna,

                'racuni_kod' => $racuni->where('status', '!=', 'storniran')->map->only('kod_operatera', 'broj_racuna', 'jikr', 'ikof', 'qr_url', 'qr_code')->toArray(),

                'redni_broj_fiskalnog_dana' => $this->pocetakDana,
            ];
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
                'ukupan_broj_racuna' => $ukupanBrojOrderRacuna,
                'ukupan_promet' => $ukupanPrometOrderRacuna,
                'ukupan_porez' => $ukupanPorezOrderRacuna
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

            'withdraw' => $this->poslovnaJedinica->depozitWithdraw()->whereNull('iznos_depozit')->get()->map->only('id', 'iznos_withdraw')->toArray(),

            'inicijalni_gotovinski_depozit' => $ukupanDepozit,
            'ukupan_promet' => $ukupanPromet,
            'non_cash_promet' => $ukupanPrometBezgotovinskihRacuna,
            'card_i_order_promet' => $ukupanPrometGotovinskihRacuna,
            'ukupno_withdraw' => $ukupanWithdraw,
            'gotovina_u_enu' => $ukupanDepozit + $ukupanPrometGotovinskihRacuna,

            'racuni_kod' => $racuni->where('status', '!=', 'storniran')->map->only('kod_operatera', 'broj_racuna', 'jikr', 'ikof', 'qr_url', 'qr_code')->toArray()
        ];
    }

    public function getVrijeme()
    {


        if ($this->tip === 'PERIODIČNI FISKALNI IZVJEŠTAJ') {

            $racuni = $this->poslovnaJedinica
                ->racuni()
                ->whereBetween('created_at', [$this->pocetakDana, $this->krajDana])
                ->get();

            return [
                'datum_dokumenta' => date('d-m-Y'),
                'vrijeme_dokumenta' => date('H:i:s'),
                'operater' => auth()->user()->punoIme,
                'fiskalni_dani_obuhvaceni_izvjestajem' =>  [
                    'od' => $this->pocetakDana,
                    'do' => $this->krajDana,
                ],
                'fiskalni_racuni_obuhvaceni_izvjestajem' => [
                    'od' => $racuni->first()->redni_broj,
                    'do' => $racuni->sortByDesc('created_at')->first()->redni_broj,
                ],
            ];
        }

        if ($this->tip === 'FISKALNI DNEVNI IZVJEŠTAJ – KRAJ DANA') {
            return [
                'datum_dokumenta' => date('d-m-Y'),
                'vrijeme_dokumenta' => date('H:i:s'),
                'operater' => auth()->user()->punoIme,
                'redni_broj_fiskalnog_dana' => $this->pocetakDana,
            ];
        }

        return [
            'datum_dokumenta' => date('d-m-Y'),
            'vrijeme_dokumenta' => date('H:i:s'),
            'operater' => auth()->user()->punoIme,
        ];
    }

    public function getRacuni($withStavke = false, $withDepozitWithdraw = false)
    {
        $racuni = $this->poslovnaJedinica
            ->racuni()
            ->where('status', '!=', 'korektivni')
            ->where('status', '!=', 'storniran')
            ->when($withStavke, function ($q) {
                return $q->with('stavke');
            })
            ->get();

        if ($withDepozitWithdraw) {
            $racuni = $racuni->merge($this->poslovnaJedinica->depozitWithdraw);
        }

        return [
            'racuni' => $racuni->toArray()
        ];
    }

    public function getOfflineRacuniKalkulacije()
    {
        $kalkulacije = $this->getKalkulacije('offline');

        return [
            'ukupno' => [
                'ukupno_osnovica_po_stopama_21_7_0' =>  $kalkulacije['ukupno']['ukupno_osnovica_po_stopama_21_7_0'],
                'ukupno_porez_po_stopama_21_7_0' =>  $kalkulacije['ukupno']['ukupno_porez_po_stopama_21_7_0'],
                'ukupan_promet' =>  $kalkulacije['ukupno']['ukupan_promet']
            ],

            'oslobodjeni_promet' => $kalkulacije['oslobodjeni_promet'],

            'ukupan_promet' => $kalkulacije['ukupan_promet'],

            'racuni_kod' => $kalkulacije['racuni_kod']
        ];
    }

    public function getKorektivniRacuniKalkulacije()
    {
        $kalkulacije = $this->getKalkulacije('korektivni_racun');

        return [
            'ukupno' => [
                'ukupno_osnovica_po_stopama_21_7_0' =>  $kalkulacije['ukupno']['ukupno_osnovica_po_stopama_21_7_0'],
                'ukupno_porez_po_stopama_21_7_0' =>  $kalkulacije['ukupno']['ukupno_porez_po_stopama_21_7_0'],
                'ukupan_promet' =>  $kalkulacije['ukupno']['ukupan_promet']
            ],

            'oslobodjeni_promet' => $kalkulacije['oslobodjeni_promet'],

            'ukupan_promet' => $kalkulacije['ukupan_promet'],

            'racuni_kod' => $kalkulacije['racuni_kod']
        ];
    }
}
