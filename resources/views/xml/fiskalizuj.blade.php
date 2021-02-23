<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
    <soapenv:Header/>
    <soapenv:Body>
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
                IssueDateTime="{{ $racun->created_at->toIso8601String() }}"
                InvNum="{{ implode('/', [$taxpayer['BU'], $racun->broj_racuna, $racun->created_at->format('Y'), $taxpayer['CR']]) }}"
                InvOrdNum="{{ $racun->broj_racuna }}"
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
                        Type="{{ $racun->nacin_placanja }}"
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
                            N="{{ $stavka->naziv }}" {{-- Name of item (goods or services) --}}
                            C="{{ $stavka->naziv }}" {{-- TODO: Code of the item from the barcode or similar representation --}}
                            U="{{ $stavka->naziv }}" {{-- TODO: Unit of measure --}}
                            Q="{{ sprintf('%0.2f', $stavka->kolicina) }}" {{-- Quantity --}}
                            UPB="{{ sprintf('%0.2f', $stavka->cijena_bez_pdv) }}" {{-- Unit price before VAT is applied --}}
                            UPA="{{ $stavka->naziv }}" {{-- TODO: Unit price after VAT is applied --}}
                            R="{{ $stavka->naziv }}" {{-- TODO: Percentage of the rebate --}}
                            RR="{{ $stavka->naziv }}" {{-- TODO: Is rebate reducing tax base amount? (true/false) --}}
                            PB="{{ $stavka->naziv }}" {{-- TODO: Total price of goods and services before the tax --}}
                            VR="{{ $stavka->naziv }}" {{-- TODO: VAT Rate --}}
                            VA="{{ $stavka->naziv }}" {{-- TODO: Amount of VAT for goods and services --}}
                            PA="{{ $stavka->naziv }}" {{-- TODO: Price after applying VAT --}}
                        />
                    @endforeach
                </Items>

{{--                TODO--}}
                <SameTaxes>
                    <SameTax></SameTax>
                </SameTaxes>
            </Invoice>
        </RegisterInvoiceRequest>
    </soapenv:Body>
</soapenv:Envelope>
