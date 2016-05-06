<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="<?php echo $resource_url; ?>css/bill.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="header">
            <div class="address-header">
                <img src="<?=FCPATH."../resource/image/logo.jpg" ?>" height="70px">
                <br />
                <strong>Primus Romulus e. V.</strong><br />
                Hauptstraße 179<br />
                8141 Unterpremstätten<br />
                <br />
                office@primus-romulus.net<br />
                www.primus-romulus.net<br />
            </div>
            <div class="address">
                <strong><?php echo $company_name; ?></strong><br />
                <?=$object_bill->bill_address; ?><br />
                <?=$object_bill->bill_pc; ?> <?php echo $object_bill->bill_city; ?><br />
            </div>
        </div>
        <div class="content">
            <table style="width: 100%; margin:30px 0; border-collapse:collapse; border-spacing:0;">
                <tr>
                    <td><strong>Rechnung: <?php echo $object_bill->bill_year; ?><?php echo $object_bill->bill_id; ?></strong></td>
                    <td style="text-align:right;">Rechnungsdatum: <?=mdate("%d.%m.%Y", mysql_to_unix($object_bill->bill_date)); ?></td>
                </tr>
            </table>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 80%;">Bezeichnung</th>
                        <th style="width: 20%; text-align:right;">Betrag in &euro;</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->Bill_Model->get_item($object_bill->bill_year, $object_bill->bill_id)->result() as $row) { ?>
                    <tr>
                        <td style="width: 80%;"><?=$row->item_text ?></td>
                        <td style="width: 20%; text-align:right;"><?=number_format($row->item_price, 2, ',', '.') ?> &euro;</td>
                    </tr>
                    <?php } ?>    
                    <tr>
                        <td style="width: 80%; text-align:right; border-bottom:0px;"><strong>Zu zahlender Betrag:</strong></td>
                        <td style="width: 20%; text-align:right; border-bottom:3px double #000000; border-top: 1px solid #000000;"><?=number_format($this->Bill_Model->get_sum($object_bill->bill_year, $object_bill->bill_id), 2, ',', '.'); ?> &euro;</td>
                    </tr>         
                </tbody>
            </table>
            <br />
            <br />
            <br />
            <div class="payment-information">
                <strong>Zahlungsinformation</strong><br />
                Bitte überweisen Sie den zu bezahlenden Betrag ohne Abzüge unter Verwendung folgender Daten:<br />
                <br />
                <strong>Empfänger:</strong> Primus Romulus e. V.<br />
                <strong>Bank:</strong> Steiermärkische Sparkasse<br />
                <strong>IBAN:</strong> AT90 2081 5000 4024 4592<br />
                <strong>BIC:</strong> STSPAT2GXXX<br />
                <strong>Verwendungszweck:</strong> <?php echo $object_bill->bill_year; ?><?php echo $object_bill->bill_id; ?>
            </div>
            <br />
            <br />
            <br />
            <div class="support">Bei Fragen zu Ihrer Rechnung wenden Sie sich bitte per E-Mail an bill@primus-romulus.net.</div>
        </div>
        <div class="footer">
            <br />
            <br />
            Danke, dass Sie sich für uns entschieden haben.<br />
            <br />
            Mit freundlichen Grüßen<br />
            <br />
            <br />
            Primus Romulus
        </div>
    </body>
</html>