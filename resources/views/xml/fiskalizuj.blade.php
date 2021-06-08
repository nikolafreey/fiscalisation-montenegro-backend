<RegisterInvoiceRequest
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns="https://efi.tax.gov.me/fs/schema"
    Id="Request"
    Version="1"
>
    <Header
        SendDateTime="{{ $danasnji_datum }}"
        UUID="{{ Str::uuid() }}"
    />

    @if($pdv_obveznik === "true")
        <Invoice
            TypeOfInv="{{ $tip_placanja }}"
            IsSimplifiedInv="false"
            IssueDateTime="{{ $danasnji_datum }}"
            @if($racun->datum_za_placanje) PayDeadline="{{ $racun->datum_za_placanje }}" @endif
            InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
            InvOrdNum="{{ $racun->redni_broj }}"
            TCRCode="{{ $taxpayer['CR'] }}"
            IsIssuerInVAT="{{ $pdv_obveznik }}"
            TotPriceWoVAT="{{ sprintf('%0.2f', $racun->ukupna_cijena_bez_pdv_popust) }}"
            TotVATAmt="{{ sprintf('%0.2f',$ukupan_pdv) }}"
            TotPrice="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv_popust) }}"
            OperatorCode="{{ $taxpayer['OP'] }}"
            BusinUnitCode="{{ $taxpayer['BU'] }}"
            SoftCode="{{ $taxpayer['SW'] }}"
            IIC="{{ $IICData['IIC'] }}"
            IICSignature="{{ $IICData['signature'] }}"
            IsReverseCharge="false"
        >
    @else
        <Invoice
            TypeOfInv="{{ $tip_placanja }}"
            IsSimplifiedInv="false"
            IssueDateTime="{{ $danasnji_datum }}"
            @if($racun->datum_za_placanje) PayDeadline="{{ $racun->datum_za_placanje }}" @endif
            InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
            InvOrdNum="{{ $racun->redni_broj }}"
            TCRCode="{{ $taxpayer['CR'] }}"
            IsIssuerInVAT="{{ $pdv_obveznik }}"
            TotPriceWoVAT="{{ sprintf('%0.2f', $racun->ukupna_cijena_bez_pdv_popust) }}"
            OperatorCode="{{ $taxpayer['OP'] }}"
            BusinUnitCode="{{ $taxpayer['BU'] }}"
            SoftCode="{{ $taxpayer['SW'] }}"
            IIC="{{ $IICData['IIC'] }}"
            IICSignature="{{ $IICData['signature'] }}"
            IsReverseCharge="false"
        >
    @endif

        <PayMethods>
            <PayMethod
                Type="{{ $nacin_placanja ?? 'BANKNOTE' }}"
                Amt="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv_popust) }}"
            />
        </PayMethods>

        <Seller
            IDType="{{ $seller['IDType'] }}"
            IDNum="{{ $taxpayer['TIN'] }}"
            Name="{{ $seller['Name'] }}"
            Address="{{ $seller['Address'] }}"
            Town="{{ $seller['Town'] }}"
            Country="{{ $seller['Country'] }}"
        />

        <Buyer
            @if($buyer['IDType']) IDType="{{ $buyer['IDType'] }}" @endif
            @if($buyer['IDNum']) IDNum="{{ $buyer['IDNum'] }}" @endif
            @if($buyer['Name']) Name="{{ $buyer['Name'] }}" @endif
            @if($buyer['Address']) Address="{{ $buyer['Address'] }}" @endif
            @if($buyer['Town']) Town="{{ $buyer['Town'] }}" @endif
            @if($buyer['Country']) Country="{{ $buyer['Country'] }}" @endif
        />

        {{-- TODO: da li rabat (popust) umanjuje osnovni iznos ili ne --}}
        <Items>
            @foreach($racun->stavke as $stavka)
                @php
                    $popust = 0;
                    if($stavka->popust_iznos > 0)
                        // TODO: provjeriti da li ovdje upisuje jedinicne cijene ili ukupne
                        // procenat popusta ako je dodat iznos
                        $popust = (1 - $stavka->cijena_bez_pdv_popust / $stavka->jedinicna_cijena_bez_pdv) * 100;
                    else
                        $popust = $stavka->popust_procenat;
                @endphp
                @if($pdv_obveznik === "true")
                    <I
                        N="{{ $stavka->naziv }}"
                        C="{{ $stavka->bar_code }}"
                        U="{{ $stavka->jedinica_mjere->naziv }}"
                        Q="{{ sprintf('%0.2f', $stavka->kolicina) }}"
                        UPB="{{ sprintf('%0.2f', $stavka->jedinicna_cijena_bez_pdv) }}"
                        UPA="{{ sprintf('%0.2f', $stavka->cijena_sa_pdv_popust) }}"
                        R="{{ sprintf('%0.2f', $popust) }}"
                        RR="true"  {{-- osnovica za izračune je jedinična cijena bez PDV-a i rabata --}}
                        {{-- PB="{{ sprintf('%0.2f', $stavka->ukupna_sa_pdv - $stavka->pdv_iznos * $stavka->kolicina) }}" --}}
                        PB="{{ sprintf('%0.2f', $stavka->ukupna_bez_pdv_popust) }}"
                        VR="{{ sprintf('%0.2f', $stavka->porez->stopa * 100) }}"
                        VA="{{ sprintf('%0.2f', round($stavka->pdv_iznos_ukupno, 2)) }}"
                        PA="{{ sprintf('%0.2f', $stavka->ukupna_sa_pdv_popust) }}"
                    />
                @else
                    <I
                        N="{{ $stavka->naziv }}"
                        C="{{ $stavka->bar_code }}"
                        U="{{ $stavka->jedinica_mjere->naziv }}"
                        Q="{{ sprintf('%0.2f', $stavka->kolicina) }}"
                        UPB="{{ sprintf('%0.2f', $stavka->jedinicna_cijena_bez_pdv) }}"
                        UPA="{{ sprintf('%0.2f', $stavka->cijena_sa_pdv_popust) }}"
                        R="{{ sprintf('%0.2f', $popust) }}"
                        RR="true"  {{-- osnovica za izračune je jedinična cijena bez PDV-a i rabata --}}
                        {{-- PB="{{ sprintf('%0.2f', $stavka->ukupna_sa_pdv - $stavka->pdv_iznos * $stavka->kolicina) }}" --}}
                        PB="{{ sprintf('%0.2f', $stavka->ukupna_bez_pdv_popust) }}"
                        EX="VAT_CL17"
                        PA="{{ sprintf('%0.2f', $stavka->ukupna_sa_pdv_popust) }}"
                    />
                @endif
            @endforeach
        </Items>

        @if($pdv_obveznik === "true")
            <SameTaxes>
                @foreach($sameTaxes as $pdv_stopa => $sameTax)
                    @if($sameTax['ukupan_broj_stavki'] != 0)
                        @if($sameTax['ukupan_iznos_pdv'] === 'oslobodjen')
                            <SameTax
                                NumOfItems="{{ (int) $sameTax['ukupan_broj_stavki'] }}"
                                PriceBefVAT="{{ sprintf("%.02f", $sameTax['ukupna_cijena_bez_pdv']) }}"
                                VATRate="0.00"
                                ExemptFromVAT="VAT_CL17"
                            />
                        @else
                            <SameTax
                                NumOfItems="{{ (int) $sameTax['ukupan_broj_stavki'] }}"
                                PriceBefVAT="{{ sprintf("%.02f", $sameTax['ukupna_cijena_bez_pdv']) }}"
                                VATRate="{{ sprintf("%.02f", $pdv_stopa * 100) }}"
                                VATAmt="{{ sprintf("%.02f", round($sameTax['ukupan_iznos_pdv'], 2)) }}"
                            />
                        @endif
                    @endif
                @endforeach
            </SameTaxes>
        @endif

    </Invoice>
</RegisterInvoiceRequest>



