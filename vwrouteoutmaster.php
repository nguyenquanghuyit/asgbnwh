<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($vwrouteout->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vwrouteoutmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($vwrouteout->RouteName->Visible) { // RouteName ?>
		<tr id="r_RouteName">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->RouteName->caption() ?></td>
			<td<?php echo $vwrouteout->RouteName->cellAttributes() ?>>
<span id="el_vwrouteout_RouteName">
<span<?php echo $vwrouteout->RouteName->viewAttributes() ?>>
<?php echo $vwrouteout->RouteName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->TruckNo->Visible) { // TruckNo ?>
		<tr id="r_TruckNo">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->TruckNo->caption() ?></td>
			<td<?php echo $vwrouteout->TruckNo->cellAttributes() ?>>
<span id="el_vwrouteout_TruckNo">
<span<?php echo $vwrouteout->TruckNo->viewAttributes() ?>>
<?php echo $vwrouteout->TruckNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->DriverName->Visible) { // DriverName ?>
		<tr id="r_DriverName">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->DriverName->caption() ?></td>
			<td<?php echo $vwrouteout->DriverName->cellAttributes() ?>>
<span id="el_vwrouteout_DriverName">
<span<?php echo $vwrouteout->DriverName->viewAttributes() ?>>
<?php echo $vwrouteout->DriverName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->DriverMobile->Visible) { // DriverMobile ?>
		<tr id="r_DriverMobile">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->DriverMobile->caption() ?></td>
			<td<?php echo $vwrouteout->DriverMobile->cellAttributes() ?>>
<span id="el_vwrouteout_DriverMobile">
<span<?php echo $vwrouteout->DriverMobile->viewAttributes() ?>>
<?php echo $vwrouteout->DriverMobile->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->InvoiceNo->Visible) { // InvoiceNo ?>
		<tr id="r_InvoiceNo">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->InvoiceNo->caption() ?></td>
			<td<?php echo $vwrouteout->InvoiceNo->cellAttributes() ?>>
<span id="el_vwrouteout_InvoiceNo">
<span<?php echo $vwrouteout->InvoiceNo->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->InvoiceDate->Visible) { // InvoiceDate ?>
		<tr id="r_InvoiceDate">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->InvoiceDate->caption() ?></td>
			<td<?php echo $vwrouteout->InvoiceDate->cellAttributes() ?>>
<span id="el_vwrouteout_InvoiceDate">
<span<?php echo $vwrouteout->InvoiceDate->viewAttributes() ?>>
<?php echo $vwrouteout->InvoiceDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->CreateUser->caption() ?></td>
			<td<?php echo $vwrouteout->CreateUser->cellAttributes() ?>>
<span id="el_vwrouteout_CreateUser">
<span<?php echo $vwrouteout->CreateUser->viewAttributes() ?>>
<?php echo $vwrouteout->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->CreateDate->caption() ?></td>
			<td<?php echo $vwrouteout->CreateDate->cellAttributes() ?>>
<span id="el_vwrouteout_CreateDate">
<span<?php echo $vwrouteout->CreateDate->viewAttributes() ?>>
<?php echo $vwrouteout->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwrouteout->SealNo->Visible) { // SealNo ?>
		<tr id="r_SealNo">
			<td class="<?php echo $vwrouteout->TableLeftColumnClass ?>"><?php echo $vwrouteout->SealNo->caption() ?></td>
			<td<?php echo $vwrouteout->SealNo->cellAttributes() ?>>
<span id="el_vwrouteout_SealNo">
<span<?php echo $vwrouteout->SealNo->viewAttributes() ?>>
<?php echo $vwrouteout->SealNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>