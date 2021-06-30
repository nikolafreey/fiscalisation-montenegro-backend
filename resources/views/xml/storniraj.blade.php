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
            InvType="CORRECTIVE"
            IsSimplifiedInv="false"
            IssueDateTime="{{ $danasnji_datum }}"
            InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
            InvOrdNum="{{ $racun->redni_broj }}"
            TCRCode="{{ $taxpayer['CR'] }}"
            IsIssuerInVAT="{{ $pdv_obveznik }}"
            TotPriceWoVAT="{{ sprintf('%0.2f', $ukupna_bez_pdv_popust) }}"
            TotVATAmt="-{{ sprintf('%0.2f', $ukupan_storniran_pdv) }}"
            TotPrice="{{ sprintf('%0.2f', $ukupna_sa_pdv_popust) }}"
            OperatorCode="{{ $taxpayer['OP'] }}"
            BusinUnitCode="{{ $taxpayer['BU'] }}"
            SoftCode="{{ $taxpayer['SW'] }}"
            IIC="{{ $IICData['IIC'] }}"
            IICSignature="{{ $IICData['signature'] }}"
            IsReverseCharge="false"
        >
            <CorrectiveInv
                IICRef="{{ $ikof }}"
                IssueDateTime="{{ $datum }}"
                Type="CORRECTIVE"
            ></CorrectiveInv>
            @else
                <Invoice
                    TypeOfInv="{{ $tip_placanja }}"
                    IsSimplifiedInv="false"
                    IssueDateTime="{{ $danasnji_datum }}"
                    InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
                    InvOrdNum="{{ $racun->redni_broj }}"
                    TCRCode="{{ $taxpayer['CR'] }}"
                    IsIssuerInVAT="{{ $pdv_obveznik }}"
                    TotPriceWoVAT="{{ sprintf('%0.2f', $racun->ukupna_cijena_bez_pdv) }}"
                    TotPrice="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv) }}"
                    TaxFreeAmt="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv) }}"
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
                            Amt="{{ sprintf('%0.2f', $ukupna_sa_pdv) }}"
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
                        IDType="{{ $buyer['IDType'] }}"
                        IDNum="{{ $buyer['IDNum'] }}"
                        Name="{{ $buyer['Name'] }}"
                        Address="{{ $buyer['Address'] }}"
                        Town="{{ $buyer['Town'] }}"
                        Country="{{ $buyer['Country'] }}"
                    />


                    {{-- TODO: da li rabat (popust) umanjuje osnovni iznos ili ne --}}
                    <Items>
                        @if($odabraneStavke)
                            @foreach($stavke as $stavka)
                                @if(in_array($stavka->id, $odabraneStavke))
                                    <I
                                        N="{{ $stavka->naziv }}"
                                        C="{{ $stavka->bar_code }}"
                                        U="{{ $stavka->jedinica_mjere->naziv }}"
                                        Q="-{{ sprintf('%0.2f', $stavka->kolicina) }}"
                                        UPB="{{ sprintf('%0.4f', $stavka->jedinicna_cijena_bez_pdv) }}"
                                        UPA="{{ sprintf('%0.4f', $stavka->cijena_sa_pdv) }}"
                                        R="{{ sprintf('%0.2f', $stavka->popust_procenat) }}"
                                        RR="{{ (bool) $stavka->popust_iznos }}"
                                        PB="-{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv - $stavka->pdv_iznos * $stavka->kolicina) }}"
                                        VR="{{ sprintf('%0.4f', $stavka->porez->stopa) }}"
                                        VA="{{ sprintf('%0.4f', round($stavka->pdv_iznos_ukupno, 2)) }}"
                                        PA="-{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv) }}"
                                    />
                                @else
                                    <I
                                        N="{{ $stavka->naziv }}"
                                        C="{{ $stavka->bar_code }}"
                                        U="{{ $stavka->jedinica_mjere->naziv }}"
                                        Q="{{ sprintf('%0.2f', $stavka->kolicina) }}"
                                        UPB="{{ sprintf('%0.4f', $stavka->jedinicna_cijena_bez_pdv) }}"
                                        UPA="{{ sprintf('%0.4f', $stavka->cijena_sa_pdv) }}"
                                        R="{{ sprintf('%0.2f', $stavka->popust_procenat) }}"
                                        RR="{{ (bool) $stavka->popust_iznos }}"
                                        PB="{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv - $stavka->pdv_iznos * $stavka->kolicina) }}"
                                        VR="{{ sprintf('%0.2f', $stavka->porez->stopa) }}"
                                        VA="{{ sprintf('%0.4f', round($stavka->pdv_iznos_ukupno, 2)) }}"
                                        PA="{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv) }}"
                                    />
                                @endif
                            @endforeach
                        @else
                            @foreach($stavke as $stavka)
                                <I
                                    N="{{ $stavka->naziv }}"
                                    C="{{ $stavka->bar_code }}"
                                    U="{{ $stavka->jedinica_mjere->naziv }}"
                                    Q="-{{ sprintf('%0.2f', $stavka->kolicina) }}"
                                    UPB="{{ sprintf('%0.4f', $stavka->jedinicna_cijena_bez_pdv) }}"
                                    UPA="{{ sprintf('%0.4f', $stavka->cijena_sa_pdv) }}"
                                    R="{{ sprintf('%0.2f', $stavka->popust_procenat) }}"
                                    RR="{{ (bool) $stavka->popust_iznos }}"
                                    PB="-{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv - $stavka->pdv_iznos * $stavka->kolicina) }}"
                                    VR="{{ sprintf('%0.4f', $stavka->porez->stopa) }}"
                                    VA="-{{ sprintf('%0.4f', round($stavka->pdv_iznos_ukupno, 4)) }}"
                                    PA="-{{ sprintf('%0.4f', $stavka->ukupna_sa_pdv) }}"
                                />
                            @endforeach
                        @endif
                    </Items>

                    @if($pdv_obveznik === "true")
                        <SameTaxes>
                            @foreach($sameTaxes as $pdv_stopa => $sameTax)
                                @if ($sameTax['ukupan_broj_stavki'] != 0)
                                    <SameTax
                                        NumOfItems="{{ (int) $sameTax['ukupan_broj_stavki'] }}"
                                        PriceBefVAT="{{ sprintf("%.02f", $sameTax['ukupna_cijena_bez_pdv']) }}"
                                        VATRate="{{ sprintf("%.02f", $pdv_stopa * 100) }}"
                                        VATAmt="{{ sprintf("%.02f", round($sameTax['ukupan_iznos_pdv'], 2)) }}"
                                        {{-- @if($sameTax["1"] == 1){
                                        ExemptFromVAT="VAT_CL17"
                                        @endif --}}
                                    />
                                @endif
                            @endforeach
                        </SameTaxes>
                    @endif
                </Invoice>
</RegisterInvoiceRequest>



