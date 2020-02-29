<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($vt_order->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vt_ordermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($vt_order->ID_Order->Visible) { // ID_Order ?>
		<tr id="r_ID_Order">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->ID_Order->caption() ?></td>
			<td<?php echo $vt_order->ID_Order->cellAttributes() ?>>
<span id="el_vt_order_ID_Order">
<span<?php echo $vt_order->ID_Order->viewAttributes() ?>>
<?php echo $vt_order->ID_Order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->OrderDate->Visible) { // OrderDate ?>
		<tr id="r_OrderDate">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->OrderDate->caption() ?></td>
			<td<?php echo $vt_order->OrderDate->cellAttributes() ?>>
<span id="el_vt_order_OrderDate">
<span<?php echo $vt_order->OrderDate->viewAttributes() ?>>
<?php echo $vt_order->OrderDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->Code->Visible) { // Code ?>
		<tr id="r_Code">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->Code->caption() ?></td>
			<td<?php echo $vt_order->Code->cellAttributes() ?>>
<span id="el_vt_order_Code">
<span<?php echo $vt_order->Code->viewAttributes() ?>>
<?php echo $vt_order->Code->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->PCS->Visible) { // PCS ?>
		<tr id="r_PCS">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->PCS->caption() ?></td>
			<td<?php echo $vt_order->PCS->cellAttributes() ?>>
<span id="el_vt_order_PCS">
<span<?php echo $vt_order->PCS->viewAttributes() ?>>
<?php echo $vt_order->PCS->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->ContactName->Visible) { // ContactName ?>
		<tr id="r_ContactName">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->ContactName->caption() ?></td>
			<td<?php echo $vt_order->ContactName->cellAttributes() ?>>
<span id="el_vt_order_ContactName">
<span<?php echo $vt_order->ContactName->viewAttributes() ?>>
<?php echo $vt_order->ContactName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->Address->Visible) { // Address ?>
		<tr id="r_Address">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->Address->caption() ?></td>
			<td<?php echo $vt_order->Address->cellAttributes() ?>>
<span id="el_vt_order_Address">
<span<?php echo $vt_order->Address->viewAttributes() ?>>
<?php echo $vt_order->Address->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->CompanyName->Visible) { // CompanyName ?>
		<tr id="r_CompanyName">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->CompanyName->caption() ?></td>
			<td<?php echo $vt_order->CompanyName->cellAttributes() ?>>
<span id="el_vt_order_CompanyName">
<span<?php echo $vt_order->CompanyName->viewAttributes() ?>>
<?php echo $vt_order->CompanyName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->ContactEmail->Visible) { // ContactEmail ?>
		<tr id="r_ContactEmail">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->ContactEmail->caption() ?></td>
			<td<?php echo $vt_order->ContactEmail->cellAttributes() ?>>
<span id="el_vt_order_ContactEmail">
<span<?php echo $vt_order->ContactEmail->viewAttributes() ?>>
<?php echo $vt_order->ContactEmail->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($vt_order->ContactPhone->Visible) { // ContactPhone ?>
		<tr id="r_ContactPhone">
			<td class="<?php echo $vt_order->TableLeftColumnClass ?>"><?php echo $vt_order->ContactPhone->caption() ?></td>
			<td<?php echo $vt_order->ContactPhone->cellAttributes() ?>>
<span id="el_vt_order_ContactPhone">
<span<?php echo $vt_order->ContactPhone->viewAttributes() ?>>
<?php echo $vt_order->ContactPhone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>