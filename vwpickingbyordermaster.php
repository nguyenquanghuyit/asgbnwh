<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($vwpickingbyorder->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vwpickingbyordermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($vwpickingbyorder->ID_Order->Visible) { // ID_Order ?>
		<tr id="r_ID_Order">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->ID_Order->caption() ?></td>
			<td<?php echo $vwpickingbyorder->ID_Order->cellAttributes() ?>>
<span id="el_vwpickingbyorder_ID_Order">
<span<?php echo $vwpickingbyorder->ID_Order->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ID_Order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->TypeName->Visible) { // TypeName ?>
		<tr id="r_TypeName">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->TypeName->caption() ?></td>
			<td<?php echo $vwpickingbyorder->TypeName->cellAttributes() ?>>
<span id="el_vwpickingbyorder_TypeName">
<span<?php echo $vwpickingbyorder->TypeName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->TypeName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->OrderDate->Visible) { // OrderDate ?>
		<tr id="r_OrderDate">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->OrderDate->caption() ?></td>
			<td<?php echo $vwpickingbyorder->OrderDate->cellAttributes() ?>>
<span id="el_vwpickingbyorder_OrderDate">
<span<?php echo $vwpickingbyorder->OrderDate->viewAttributes() ?>>
<?php echo $vwpickingbyorder->OrderDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->ContactName->Visible) { // ContactName ?>
		<tr id="r_ContactName">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->ContactName->caption() ?></td>
			<td<?php echo $vwpickingbyorder->ContactName->cellAttributes() ?>>
<span id="el_vwpickingbyorder_ContactName">
<span<?php echo $vwpickingbyorder->ContactName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ContactName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->ContactPhone->Visible) { // ContactPhone ?>
		<tr id="r_ContactPhone">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->ContactPhone->caption() ?></td>
			<td<?php echo $vwpickingbyorder->ContactPhone->cellAttributes() ?>>
<span id="el_vwpickingbyorder_ContactPhone">
<span<?php echo $vwpickingbyorder->ContactPhone->viewAttributes() ?>>
<?php echo $vwpickingbyorder->ContactPhone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->CompanyName->Visible) { // CompanyName ?>
		<tr id="r_CompanyName">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->CompanyName->caption() ?></td>
			<td<?php echo $vwpickingbyorder->CompanyName->cellAttributes() ?>>
<span id="el_vwpickingbyorder_CompanyName">
<span<?php echo $vwpickingbyorder->CompanyName->viewAttributes() ?>>
<?php echo $vwpickingbyorder->CompanyName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vwpickingbyorder->StatusLoad->Visible) { // StatusLoad ?>
		<tr id="r_StatusLoad">
			<td class="<?php echo $vwpickingbyorder->TableLeftColumnClass ?>"><?php echo $vwpickingbyorder->StatusLoad->caption() ?></td>
			<td<?php echo $vwpickingbyorder->StatusLoad->cellAttributes() ?>>
<span id="el_vwpickingbyorder_StatusLoad">
<span<?php echo $vwpickingbyorder->StatusLoad->viewAttributes() ?>>
<?php echo $vwpickingbyorder->StatusLoad->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>