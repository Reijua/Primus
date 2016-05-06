<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo $resource_url; ?>css/bill.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="header">
            <img src="<?php echo $resource_url; ?>image/logo.png" height="70px">
            <br />
            <strong>Primus Romulus e. V.</strong><br />
            Hauptstraße 179<br />
            8141 Unterpremstätten<br />
            <br />
            office@primus-romulus.net<br />
            +43 664 51 33 691<br />
            www.primus-romulus.net<br />
        </div>
        <div class="company-address">
            <strong><?php echo $company_name; ?></strong><br />
            <?php echo $bill->bill_address; ?><br />
            <?php echo $bill->bill_pc; ?> <?php echo $bill->bill_city; ?><br />
        </div>
        <div class="bill">
            <table width="100%">
                <tr>
                    <td><h3>Rechnung: <?php echo $bill->bill_year; ?><?php echo $bill->bill_id; ?></h3></td>
                    <td align="right">Rechnungsdatum: <?php echo $bill->bill_fdate; ?></td>
                </tr>
            </table>
            <table class="bill-table" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="table-header" width="80%">Bezeichnung</td>
                    <td class="table-header" width="20%" align="right">Betrag in &euro;</td>
                </tr>
                <?php
                $sum = 0;
                foreach ($array_bill_item as $row) {
                    echo '<tr>
                                <td>'.$this->lang->line($row->item_name).'</td>
                                <td align="right">'.number_format($row->item_price, 2, ',', '.').' &euro; </td>
                          </tr>';
                    $sum += $row->item_price;
                }
                ?>
                <tr >
                    <td width="80%" align="right"><strong>Zu zahlender Betrag:</strong></td>
                    <td width="20%" class="sum"><?php echo number_format($sum, 2, ',', '.'); ?> &euro;</td>
                </tr>
            </table>
        </div>
        <div class="payment-information">
            <strong>Zahlungsinformation</strong><br />
            Bitte überweisen Sie den zu bezahlenden Betrag ohne Abzüge unter Verwendung folgender Daten:<br />
            <br />
            <strong>Empfänger:</strong> Primus Romulus e. V.<br />
            <strong>Bank:</strong> Steiermärkische Sparkasse<br />
            <strong>IBAN:</strong> AT90 2081 5000 4024 4592<br />
            <strong>BIC:</strong> STSPAT2GXXX<br />
            <strong>Verwendungszweck:</strong> <?php echo $bill->bill_year; ?><?php echo $bill->bill_id; ?>
        </div>
        <div class="support">
            Bei Fragen zu Ihrer Rechnung wenden Sie sich bitte per E-Mail an bill@primus-romulus.net.
        </div>
        <div style="position:relative; float:left">
            <br />
            <br />
            Danke, dass Sie sich für uns entschieden haben.<br />
            <br />
            Mit freundlichen Grüßen<br />
            <br />
            Primus Romulus
        </div>
    </body>
</html>