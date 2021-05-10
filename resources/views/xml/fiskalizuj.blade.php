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

    <Invoice
        TypeOfInv="{{ $tip_placanja }}"
        IsSimplifiedInv="false"
        IssueDateTime="{{ $danasnji_datum }}"
        InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
        InvOrdNum="{{ $racun->redni_broj }}"
        TCRCode="{{ $taxpayer['CR'] }}"
        IsIssuerInVAT="true"
        TotPriceWoVAT="{{ sprintf('%0.2f', round($ukupna_cijena_bez_pdv, 2)) }}"
        TotVATAmt="{{ sprintf('%0.2f', round($ukupan_pdv, 2)) }}"
        TotPrice="{{ sprintf('%0.2f', round($ukupna_cijena, 2)) }}"
        OperatorCode="{{ $taxpayer['OP'] }}"
        BusinUnitCode="{{ $taxpayer['BU'] }}"
        SoftCode="{{ $taxpayer['SW'] }}"
        IIC="{{ $IICData['IIC'] }}"
        IICSignature="{{ $IICData['signature'] }}"
        IsReverseCharge="false"
    >
        <PayMethods>
            <PayMethod
                {{-- TODO: --}}
                Type="{{ $nacin_placanja ?? 'BANKNOTE' }}"
                Amt="{{ sprintf('%0.2f', round($racun->ukupna_cijena_sa_pdv, 2)) }}"
            />
        </PayMethods>

        <Seller
            IDType="{{ $seller['IDType'] }}"
            IDNum="{{ $taxpayer['TIN'] }}"
            Name="{{ $seller['Name'] }}"
        />

        <Buyer
            IDType="{{ $buyer['IDType'] }}"
            IDNum="{{ $buyer['IDNum'] }}"
            Name="{{ $buyer['Name'] }}"
        />

        <Items>
            @foreach($racun->stavke as $stavka)
                <I
                    N="{{ $stavka->naziv }}"
                    C="{{ $stavka->bar_code }}"
                    U="{{ $stavka->jedinica_mjere->naziv }}"
                    Q="{{ $stavka->kolicina }}"
                    UPB="{{ $stavka->jedinicna_cijena_bez_pdv }}"
                    UPA="{{ $stavka->cijena_sa_pdv }}"
                    R="{{ $stavka->popust_procenat }}"
                    RR="{{ (bool) $stavka->popust_iznos }}"
                    PB="{{ sprintf('%0.2f', round($stavka->ukupna_sa_pdv, 2) - round($stavka->pdv_iznos * $stavka->kolicina, 2)) }}"
                    VR="{{ $stavka->porez->stopa }}"
                    VA="{{ $stavka->pdv_iznos * $stavka->kolicina }}"
                    PA="{{ $stavka->ukupna_sa_pdv }}"
                />
            @endforeach
        </Items>


        <SameTaxes>
            @foreach($sameTaxes as $pdv_stopa => $sameTax)
                @if ($sameTax['ukupan_broj_stavki'] != 0)
                    <SameTax
                        {{-- TODO: Check if it should be integer ? --}}
                        NumOfItems="{{ (int) $sameTax['ukupan_broj_stavki'] }}"
                        PriceBefVAT="{{ sprintf("%.02f", round($sameTax['ukupna_cijena_bez_pdv'], 2)) }}"
                        VATRate="{{ sprintf("%.02f", round($pdv_stopa, 2) * 100) }}"
                        VATAmt="{{ sprintf("%.02f", round($sameTax['ukupan_iznos_pdv'], 2)) }}"
                    />
                @endif
            @endforeach
        </SameTaxes>
    </Invoice>
</RegisterInvoiceRequest>



