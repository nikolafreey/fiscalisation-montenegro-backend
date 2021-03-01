<RegisterCashDepositRequest
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

    <CashDeposit
        CashAmt="{{ sprintf("%.02f", $depozit->iznos_depozit) }}"
        ChangeDateTime="{{ $danasnji_datum }}"
        IssuerTIN="{{ $taxpayer['TIN'] }}"
        Operation="INITIAL"
        TCRCode="{{ $taxpayer['OP'] }}"
    />
</RegisterCashDepositRequest>