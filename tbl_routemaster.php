<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_route->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_routemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_route->RouteName->Visible) { // RouteName ?>
		<tr id="r_RouteName">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->RouteName->caption() ?></td>
			<td<?php echo $tbl_route->RouteName->cellAttributes() ?>>
<span id="el_tbl_route_RouteName">
<span<?php echo $tbl_route->RouteName->viewAttributes() ?>>
<?php echo $tbl_route->RouteName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->TruckNo->Visible) { // TruckNo ?>
		<tr id="r_TruckNo">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->TruckNo->caption() ?></td>
			<td<?php echo $tbl_route->TruckNo->cellAttributes() ?>>
<span id="el_tbl_route_TruckNo">
<span<?php echo $tbl_route->TruckNo->viewAttributes() ?>>
<?php echo $tbl_route->TruckNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->DriverName->Visible) { // DriverName ?>
		<tr id="r_DriverName">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->DriverName->caption() ?></td>
			<td<?php echo $tbl_route->DriverName->cellAttributes() ?>>
<span id="el_tbl_route_DriverName">
<span<?php echo $tbl_route->DriverName->viewAttributes() ?>>
<?php echo $tbl_route->DriverName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->DriverMobile->Visible) { // DriverMobile ?>
		<tr id="r_DriverMobile">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->DriverMobile->caption() ?></td>
			<td<?php echo $tbl_route->DriverMobile->cellAttributes() ?>>
<span id="el_tbl_route_DriverMobile">
<span<?php echo $tbl_route->DriverMobile->viewAttributes() ?>>
<?php echo $tbl_route->DriverMobile->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->InvoiceNo->Visible) { // InvoiceNo ?>
		<tr id="r_InvoiceNo">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->InvoiceNo->caption() ?></td>
			<td<?php echo $tbl_route->InvoiceNo->cellAttributes() ?>>
<span id="el_tbl_route_InvoiceNo">
<span<?php echo $tbl_route->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->InvoiceDate->Visible) { // InvoiceDate ?>
		<tr id="r_InvoiceDate">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->InvoiceDate->caption() ?></td>
			<td<?php echo $tbl_route->InvoiceDate->cellAttributes() ?>>
<span id="el_tbl_route_InvoiceDate">
<span<?php echo $tbl_route->InvoiceDate->viewAttributes() ?>>
<?php echo $tbl_route->InvoiceDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->CreateUser->caption() ?></td>
			<td<?php echo $tbl_route->CreateUser->cellAttributes() ?>>
<span id="el_tbl_route_CreateUser">
<span<?php echo $tbl_route->CreateUser->viewAttributes() ?>>
<?php echo $tbl_route->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->CreateDate->caption() ?></td>
			<td<?php echo $tbl_route->CreateDate->cellAttributes() ?>>
<span id="el_tbl_route_CreateDate">
<span<?php echo $tbl_route->CreateDate->viewAttributes() ?>>
<?php echo $tbl_route->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->FinishUnload->Visible) { // FinishUnload ?>
		<tr id="r_FinishUnload">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->FinishUnload->caption() ?></td>
			<td<?php echo $tbl_route->FinishUnload->cellAttributes() ?>>
<span id="el_tbl_route_FinishUnload">
<span<?php echo $tbl_route->FinishUnload->viewAttributes() ?>>
<?php echo $tbl_route->FinishUnload->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->SealNo->Visible) { // SealNo ?>
		<tr id="r_SealNo">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->SealNo->caption() ?></td>
			<td<?php echo $tbl_route->SealNo->cellAttributes() ?>>
<span id="el_tbl_route_SealNo">
<span<?php echo $tbl_route->SealNo->viewAttributes() ?>>
<?php echo $tbl_route->SealNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->AttachFile->Visible) { // AttachFile ?>
		<tr id="r_AttachFile">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->AttachFile->caption() ?></td>
			<td<?php echo $tbl_route->AttachFile->cellAttributes() ?>>
<span id="el_tbl_route_AttachFile">
<span<?php echo $tbl_route->AttachFile->viewAttributes() ?>>
<?php echo GetFileViewTag($tbl_route->AttachFile, $tbl_route->AttachFile->getViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->LoadingID->Visible) { // LoadingID ?>
		<tr id="r_LoadingID">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->LoadingID->caption() ?></td>
			<td<?php echo $tbl_route->LoadingID->cellAttributes() ?>>
<span id="el_tbl_route_LoadingID">
<span<?php echo $tbl_route->LoadingID->viewAttributes() ?>>
<?php echo $tbl_route->LoadingID->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_route->Id_Type->Visible) { // Id_Type ?>
		<tr id="r_Id_Type">
			<td class="<?php echo $tbl_route->TableLeftColumnClass ?>"><?php echo $tbl_route->Id_Type->caption() ?></td>
			<td<?php echo $tbl_route->Id_Type->cellAttributes() ?>>
<span id="el_tbl_route_Id_Type">
<span<?php echo $tbl_route->Id_Type->viewAttributes() ?>>
<?php echo $tbl_route->Id_Type->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>