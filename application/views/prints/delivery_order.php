<style>
    /* Font Definitions */
    @font-face {
        font-family: SimSun;
        panose-1: 2 1 6 0 3 1 1 1 1 1;
    }

    @font-face {
        font-family: "Cambria Math";
        panose-1: 2 4 5 3 5 4 6 3 2 4;
    }

    @font-face {
        font-family: Calibri;
        panose-1: 2 15 5 2 2 2 4 3 2 4;
    }

    @font-face {
        font-family: "\@SimSun";
        panose-1: 2 1 6 0 3 1 1 1 1 1;
    }

    /* Style Definitions */
    p.MsoNormal,
    li.MsoNormal,
    div.MsoNormal {
        margin-top: 0in;
        margin-right: 0in;
        margin-bottom: 10.0pt;
        margin-left: 0in;
        line-height: 120%;
        font-size: 10.5pt;
        font-family: "Calibri", sans-serif;
    }

    .MsoChpDefault {
        font-size: 10.5pt;
        font-family: "Calibri", sans-serif;
    }

    .MsoPapDefault {
        margin-bottom: 10.0pt;
        line-height: 120%;
    }

    @page WordSection1 {
        size: 595.35pt 841.95pt;
        margin: 1.0in 1.0in 1.0in 1.0in;
    }

    .MsoMargin {
        margin-bottom: 0.1rem;
    }

    div.WordSection1 {
        page: WordSection1;
    }

    .table {
        width: 100%;
    }

    .container-1 {
        display: flex;
    }

    .container-1 div {
        /* border: 1px #ccc solid; */
        padding: 0px;
        align-items: center;
    }

    .box-1 {
        flex: 1.2;
    }

    .box-2 {
        flex: 1;
    }

    .box-3 {
        flex: 1.2;
    }
</style>

<?php
$do = $deliveryorder;
?>

<div class=WordSection1>

    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><img width=79 height=79 src="https://im7.ezgif.com/tmp/ezgif-7-b378ab115409.png" align=left hspace=12><span style='font-size:18.0pt;line-height:120%;font-family:"Times New Roman",serif;
color:#1F4E79'>PT. NANANG NUSANTARA TRITAMA</span></p>

    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><span style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif;
color:#1F4E79'>Jl. Kebon Jeruk 19 No. 100 Jakarta Kota 11160</span></p>

    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center'><span style='font-size:11.0pt;line-height:120%;font-family:"Arial",sans-serif;
color:#1F4E79'>Telp. : (021) 649 9545 Fax. : (021) 649 8622</span></p>

    <div style='border:none;border-bottom:double #1F4E79 6.0pt;padding:0in 0in 1.0pt 0in'>

        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
border:none;padding:0in'><span style='font-size:11.0pt;line-height:120%;
font-family:"Arial",sans-serif;color:#1F4E79'>NPWP 02.063.192.5-032.000</span></p>

        <p class=MsoNormal style='margin-bottom:0in;border:none;padding:0in'><span style='line-height:120%;font-family:"Arial",sans-serif;color:#1F4E79'>&nbsp;</span></p>

    </div>

    <div class="container-1">
        <div class="box-1">
            <p style="margin-left:40px"><span style="color:#2980b9; font-size: small;">Kepada Yth,</span></p>
            <p style="border-bottom: 1px dotted #000; text-decoration: none;"><span style="font-size: small"><?= $do->Name ?></span></p>
            <p style="border-bottom: 1px dotted #000; text-decoration: none;"><span style=" font-size: small">PO. NO. <?= $do->PO_Number ?></span></p>
            <p style="border-bottom: 1px dotted #000; text-decoration: none; margin-right: 60px;"><span style=" font-size: small">DI <?= $do->Location ?></span></p>
        </div>
        <div class="box-2">
            <div style="text-align:center; margin-top: 80px;"><span style="color:#2980b9"><u><span style="font-size:22">SURAT JALAN</span></u></span></div>
            <div style="text-align:center;"><span style="color:#2980b9;">No. : </span><span style=" font-size:small"> <?= $do->DO_Number ?></span></div>
        </div>
        <div class="box-3">
            <p style="margin-left:30px"><span style="color:#2980b9; font-size: small;">Jakarta<strong>,</strong></span><span> <?= date('j F Y', strtotime($do->Date)) ?></span></p>
        </div>
    </div>






    <table class=MsoTableGridLight border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
        <tr style='height:31.9pt'>
            <td width=42 style='width:31.25pt;border:solid #4472C4 1.0pt;padding:0in 5.4pt 0in 5.4pt;
  height:31.9pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b><span style='font-size:11.0pt;font-family:"Times New Roman",serif;
  color:#1F4E79'>No.</span></b></p>
            </td>
            <td width=102 style='width:76.5pt;border:solid #4472C4 1.0pt;border-left:
  none;padding:0in 5.4pt 0in 5.4pt;height:31.9pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b><span style='font-size:11.0pt;font-family:"Times New Roman",serif;
  color:#1F4E79'>Banyaknya</span></b></p>
            </td>
            <td width=342 style='width:256.5pt;border:solid #4472C4 1.0pt;border-left:
  none;padding:0in 5.4pt 0in 5.4pt;height:31.9pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b><span style='font-size:11.0pt;font-family:"Times New Roman",serif;
  color:#1F4E79'>Nama Barang</span></b></p>
            </td>
            <td width=115 style='width:86.6pt;border:solid #4472C4 1.0pt;border-left:
  none;padding:0in 5.4pt 0in 5.4pt;height:31.9pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><b><span style='font-size:11.0pt;font-family:"Times New Roman",serif;
  color:#1F4E79'>Keterangan</span></b></p>
            </td>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($orderdetail as $od) : ?>
            <tr style='height:22.0pt'>
                <td width=42 style='width:31.25pt;border-top:none;border-left:solid #4472C4 1.0pt;
  border-bottom:none;border-right:solid #4472C4 1.0pt;padding:0in 5.4pt 0in 5.4pt;
  height:22.0pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'><?= $i++ ?>.</span></p>
                </td>
                <td width=102 style='width:76.5pt;border:none;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'><?= $od->Qty_Sent ?> PCS</span></p>
                </td>
                <td width=342 style='width:256.5pt;border:none;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
                    <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span style='font-family:"Arial",sans-serif'><?= $od->Name ?></span></p>
                </td>
                <td width=115 style='width:86.6pt;border:none;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:22.0pt'>
                    <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr style='height:26.5pt'>
            <td width=42 style='width:31.25pt;border:solid #4472C4 1.0pt;border-top:none;
  padding:0in 5.4pt 0in 5.4pt;height:26.5pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
            </td>
            <td width=102 style='width:76.5pt;border-top:none;border-left:none;
  border-bottom:solid #4472C4 1.0pt;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.5pt'>
                <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
            </td>
            <td width=342 style='width:256.5pt;border-top:none;border-left:none;
  border-bottom:solid #4472C4 1.0pt;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.5pt'>
                <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
            </td>
            <td width=115 style='width:86.6pt;border-top:none;border-left:none;
  border-bottom:solid #4472C4 1.0pt;border-right:solid #4472C4 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.5pt'>

            </td>
        </tr>
        <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-family:"Arial",sans-serif'>&nbsp;</span></p>
    </table>



    <div class="container-1">
        <div class="box-1">
            <div style="margin-left:50px;color:#2980b9;margin-top:2rem;font-size:small;">Penerima</div>
            <div style="color:#2980b9;font-size:small;margin-left:25px">Tanda Tangan / Cap</div>
            <div style="margin-top: 62px;"><span style="color:#2980b9;">(......................................)</span></div>
        </div>
        <div class="box-3">
            <div style="text-align:right; margin-right:45px; color:#2980b9;margin-top:2rem;font-size:small;">Hormat Kami,</div>
            <div style="text-align:right; margin-top:80px"><span style="color:#2980b9">(......................................)</span></div>
        </div>
    </div>

</div>