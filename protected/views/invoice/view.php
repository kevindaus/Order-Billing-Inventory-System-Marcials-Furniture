<?php
/**
 * @var Orders $model
 * @var ProductOrders $currentProductOrders
 */

$addressFull = $model->shipping_address;
$addressFullArr = explode(",",$addressFull);
$addressPart1 = implode(",",array_splice($addressFullArr, 0, 2));
$addressPart2 =implode(",",$addressFullArr);

?>
<html>
<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 14 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
    {font-family:"Cambria Math";
    panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
    {font-family:Tahoma;
    panose-1:2 11 6 4 3 5 4 4 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {margin:0in;
    margin-bottom:.0001pt;
    font-size:10.0pt;
    font-family:"Arial","sans-serif";
    color:black;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
    {margin:0in;
    margin-bottom:.0001pt;
    font-size:8.0pt;
    font-family:"Tahoma","sans-serif";
    color:black;}
@page WordSection1
    {size:8.5in 11.0in;
    margin:1.0in .5in 1.0in .5in;}
div.WordSection1
    {page:WordSection1;}
-->
</style>

</head>

<body bgcolor=white lang=EN-US style="width: 500px">
<div class=WordSection1>
<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width="50%"
 style='width:100.0%;border-collapse:collapse;border:none'>
 <tr>
  <td width=185 rowspan=4 style='width:138.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'></p>
  </td>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span
  style='font-size:14.0pt'><?php echo Yii::app()->name ?></span></b></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b><span style='font-size:20.0pt;font-family:"Times New Roman","serif"'>INVOICE</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:12.0pt'><?php echo Yii::app()->getParams()['company_street']?></span></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>Invoice Number: </span></p>
  </td>
 </tr>
 <tr>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:12.0pt'><?php echo Yii::app()->params['company_city']?></span></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'></span></p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>
          <strong>
            <?php echo $model->invoice_number ?>
          </strong>
  </span>
  </p>
  </td>
 </tr>
 <tr>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:12.0pt'><?php echo Yii::app()->params['company_tel_number']?></span></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>Invoice Date:</span></p>
  </td>
 </tr>
 <tr>
  <td width=185 style='width:138.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><span
  style='font-size:12.0pt'></span></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>
          <strong>
            <?php echo date("F d,Y",strtotime($model->date_created))?>
          </strong>
      </span>
  </p>
  </td>
 </tr>
 <tr>
  <td width=185 style='width:138.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=278 style='width:208.7pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=48 style='width:.5in;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=223 style='width:167.4pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><br>
Customer Information:<br>
<br>
</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:50%;border-collapse:collapse;border:none'>
 <tr>
  <td width=367 colspan=2 style='width:275.4pt;border:solid windowtext 1.0pt;
  background:#E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b>Billing Address:</b></p>
  </td>
  <td width=367 colspan=2 style='width:275.4pt;border:solid windowtext 1.0pt;
  border-left:none;background:#E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b>Shipping Address:</b></p>
  </td>
 </tr>
 <tr>
  <td width=115 style='width:1.2in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Company:</span></p>
  </td>
  <td width=252 style='width:189.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=108 style='width:81.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Company:</span></p>
  </td>
  <td width=259 style='width:2.7in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
 </tr>
 <tr>
  <td width=115 style='width:1.2in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Name:</span></p>
  </td>
  <td width=252 style='width:189.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'><?php echo sprintf("%s. %s %s",$model->customer->title,$model->customer->firstname , $model->customer->lastname) ?></span></p>
  </td>
  <td width=108 style='width:81.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Name:</span></p>
  </td>
  <td width=259 style='width:2.7in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
      <p class=MsoNormal><span style='font-size:12.0pt'><?php echo sprintf("%s. %s %s",$model->customer->title,$model->customer->firstname , $model->customer->lastname) ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=115 style='width:1.2in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Address:</span></p>
  </td>
  <td width=252 style='width:189.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'><?php echo $addressPart1?>;</span></p>
  </td>
  <td width=108 style='width:81.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>Address:</span></p>
  </td>
  <td width=259 style='width:2.7in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
      <p class=MsoNormal><span style='font-size:12.0pt'><?php echo $addressPart1?>;</span></p>
  </td>
 </tr>
 <tr>
  <td width=115 style='width:1.2in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>&nbsp;</span></p>
  </td>
  <td width=252 style='width:189.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
      <p class=MsoNormal><span style='font-size:12.0pt'><?php echo $addressPart2?>;</span></p>
  </td>
  <td width=108 style='width:81.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:8.0pt'>&nbsp;</span></p>
  </td>
  <td width=259 style='width:2.7in;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt'>
      <p class=MsoNormal><span style='font-size:12.0pt'><?php echo $addressPart2?>;</span></p>
  </td>
 </tr>

</table>

<p class=MsoNormal>&nbsp;</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="50%"
 style='width:100.0%;border-collapse:collapse;border:none'>
 <tr>
  <td width=343 style='width:257.4pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=132 style='width:99.0pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b></b></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><br>
Order Information:<br>
<br>
</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 width="50%"
 style='width:100.0%;border-collapse:collapse;border:none'>
 <tr>
  <td width=91 style='width:.95in;border:solid windowtext 1.0pt;background:
  #E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Qty</b></p>
  </td>
  <td width=348 style='width:261.0pt;border:solid windowtext 1.0pt;border-left:
  none;background:#E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Product
  Description</b></p>
  </td>
  <td width=152 style='width:114.0pt;border:solid windowtext 1.0pt;border-left:
  none;background:#E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Amount Each</b></p>
  </td>
  <td width=151 style='width:113.4pt;border:solid windowtext 1.0pt;border-left:
  none;background:#E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=center style='text-align:center'><b>Amount</b></p>
  </td>
 </tr>

<?php foreach ($model->productOrders as $key => $currentProductOrders): ?>

 <tr>
  <td width=91 style='width:.95in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>
  <?php echo $currentProductOrders->quantity ?>
  </span></p>
  </td>
  <td width=348 style='width:261.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>
  <?php echo $currentProductOrders->product->name ?>
  </span></p>
  </td>
  <td width=152 style='width:114.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:12.0pt'>
  <?php echo $currentProductOrders->product->price ?>
  </span></p>
  </td>
  <td width=151 style='width:113.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:12.0pt'>

  <?php echo (doubleval($currentProductOrders->quantity) * doubleval($currentProductOrders->product->price)) ?>

  </span></p>
  </td>
 </tr>

<?php endforeach ?>



 <tr>
  <td width=91 style='width:.95in;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'></span></p>
  </td>
  <td width=348 style='width:261.0pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=152 style='width:114.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:8.0pt'>Subtotal:</span></p>
  </td>
  <td width=151 style='width:113.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:12.0pt'><?php echo $model->sub_total ?></span></p>
  </td>
 </tr>




 <tr>
  <td width=91 style='width:.95in;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=348 style='width:261.0pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=152 style='width:114.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:8.0pt'>Tax: </span></p>
  </td>
  <td width=151 style='width:113.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:12.0pt'><?php echo number_format((doubleval($model->tax) * doubleval($model->sub_total))/100,2) ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=91 style='width:.95in;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=348 style='width:261.0pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
  <td width=152 style='width:114.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:8.0pt'>Shipping:</span></p>
  </td>
  <td width=151 style='width:113.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><span
  style='font-size:12.0pt'><?php echo $model->shipping_amt ?></span></p>
  </td>
 </tr>
 <tr>
  <td width=91 style='width:.95in;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=348 style='width:261.0pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=152 style='width:114.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><b>Grand Total:</b></p>
  </td>
  <td width=151 style='width:113.4pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal align=right style='text-align:right'><?php echo $model->total_amt ?></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><br>
<br>
</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=734 style='width:7.65in;border:solid windowtext 1.0pt;background:
  #E6E6E6;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><b>Notes:</b></p>
  </td>
 </tr>
 <tr>
  <td width=734 style='width:7.65in;border:solid windowtext 1.0pt;border-top:
  none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal><span style='font-size:12.0pt'><?php echo $model->note ?></span></p>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  <p class=MsoNormal><span style='font-size:12.0pt'>&nbsp;</span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal><br>
<b><span style='font-size:8.0pt'>Additional Information:</span></b><span
style='font-size:8.0pt'> Sales, Events, Conditions of Sale, Warranty
Information, Shipping Options or other policies can be mentioned here. </span></p>

</div>

</body>

</html>
