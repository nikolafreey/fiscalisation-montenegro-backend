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
        TypeOfInv="NONCASH"
        IsSimplifiedInv="false"
        IssueDateTime="{{ $danasnji_datum }}"
        InvNum="{{ implode('/', [$taxpayer['BU'], $racun->redni_broj, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
        InvOrdNum="{{ $racun->redni_broj }}"
        TCRCode="{{ $taxpayer['CR'] }}"
        IsIssuerInVAT="true"
        TotPriceWoVAT="{{ sprintf('%0.2f', $racun->ukupna_cijena_bez_pdv) }}"
        TotVATAmt="{{ sprintf('%0.2f', $racun->ukupan_iznos_pdv) }}"
        TotPrice="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv) }}"
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
                Type="{{ $racun->nacin_placanja ?? 'BANKNOTE' }}"
                Amt="{{ sprintf('%0.2f', $racun->ukupna_cijena_sa_pdv) }}"
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
                    Q="{{ sprintf('%0.2f', $stavka->kolicina) }}"
                    UPB="{{ sprintf('%0.2f', $stavka->jedinicna_cijena_bez_pdv) }}"
                    UPA="{{ sprintf('%0.2f', $stavka->jedinicna_cijena_sa_pdv) }}"
                    R="{{ sprintf('%0.2f', $stavka->popust_procenat) }}"
                    RR="{{ (bool) $stavka->popust_iznos }}"
                    PB="{{ sprintf('%0.2f', $stavka->cijena_bez_pdv) }}"
                    VR="{{ sprintf('%0.2f', $stavka->porez->stopa) }}"
                    VA="{{ sprintf('%0.2f', $stavka->pdv_iznos) }}"
                    PA="{{ sprintf('%0.2f', $stavka->cijena_sa_pdv) }}"
                />
            @endforeach
        </Items>

        <SameTaxes>
            @foreach($sameTaxes as $pdv_stopa => $sameTax)
                @if ($sameTax['ukupna_kolicina'] != 0)
                    <SameTax
                        {{-- TODO: Check if it should be integer ? --}}
                        NumOfItems="{{ (int) $sameTax['ukupna_kolicina'] }}"
                        PriceBefVAT="{{ sprintf("%.02f", $sameTax['ukupna_cijena_bez_pdv']) }}"
                        VATRate="{{ sprintf("%.02f", $pdv_stopa * 100) }}"
                        VATAmt="{{ sprintf("%.02f", $sameTax['ukupan_iznos_pdv']) }}"
                    />
                @endif
            @endforeach
        </SameTaxes>
    </Invoice>
</RegisterInvoiceRequest>



