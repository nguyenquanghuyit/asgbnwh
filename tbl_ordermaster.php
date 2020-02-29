<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_order->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_ordermaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_order->ID_Order->Visible) { // ID_Order ?>
		<tr id="r_ID_Order">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->ID_Order->caption() ?></td>
			<td<?php echo $tbl_order->ID_Order->cellAttributes() ?>>
<span id="el_tbl_order_ID_Order">
<span<?php echo $tbl_order->ID_Order->viewAttributes() ?>>
<?php echo $tbl_order->ID_Order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->OrderDate->Visible) { // OrderDate ?>
		<tr id="r_OrderDate">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->OrderDate->caption() ?></td>
			<td<?php echo $tbl_order->OrderDate->cellAttributes() ?>>
<span id="el_tbl_order_OrderDate">
<span<?php echo $tbl_order->OrderDate->viewAttributes() ?>>
<?php echo $tbl_order->OrderDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->InvoiceNo->Visible) { // InvoiceNo ?>
		<tr id="r_InvoiceNo">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->InvoiceNo->caption() ?></td>
			<td<?php echo $tbl_order->InvoiceNo->cellAttributes() ?>>
<span id="el_tbl_order_InvoiceNo">
<span<?php echo $tbl_order->InvoiceNo->viewAttributes() ?>>
<?php echo $tbl_order->InvoiceNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<tr id="r_CusomterOrderNo">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->CusomterOrderNo->caption() ?></td>
			<td<?php echo $tbl_order->CusomterOrderNo->cellAttributes() ?>>
<span id="el_tbl_order_CusomterOrderNo">
<span<?php echo $tbl_order->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_order->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->IdType->Visible) { // IdType ?>
		<tr id="r_IdType">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->IdType->caption() ?></td>
			<td<?php echo $tbl_order->IdType->cellAttributes() ?>>
<span id="el_tbl_order_IdType">
<span<?php echo $tbl_order->IdType->viewAttributes() ?>>
<?php echo $tbl_order->IdType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->ID_Contact->Visible) { // ID_Contact ?>
		<tr id="r_ID_Contact">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->ID_Contact->caption() ?></td>
			<td<?php echo $tbl_order->ID_Contact->cellAttributes() ?>>
<span id="el_tbl_order_ID_Contact">
<span<?php echo $tbl_order->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_order->ID_Contact->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->CreateUser->caption() ?></td>
			<td<?php echo $tbl_order->CreateUser->cellAttributes() ?>>
<span id="el_tbl_order_CreateUser">
<span<?php echo $tbl_order->CreateUser->viewAttributes() ?>>
<?php echo $tbl_order->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->CreateDate->caption() ?></td>
			<td<?php echo $tbl_order->CreateDate->cellAttributes() ?>>
<span id="el_tbl_order_CreateDate">
<span<?php echo $tbl_order->CreateDate->viewAttributes() ?>>
<?php echo $tbl_order->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->StatusLoad->Visible) { // StatusLoad ?>
		<tr id="r_StatusLoad">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->StatusLoad->caption() ?></td>
			<td<?php echo $tbl_order->StatusLoad->cellAttributes() ?>>
<span id="el_tbl_order_StatusLoad">
<span<?php echo $tbl_order->StatusLoad->viewAttributes() ?>>
<?php echo $tbl_order->StatusLoad->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_order->StatusFinishOrder->Visible) { // StatusFinishOrder ?>
		<tr id="r_StatusFinishOrder">
			<td class="<?php echo $tbl_order->TableLeftColumnClass ?>"><?php echo $tbl_order->StatusFinishOrder->caption() ?></td>
			<td<?php echo $tbl_order->StatusFinishOrder->cellAttributes() ?>>
<span id="el_tbl_order_StatusFinishOrder">
<span<?php echo $tbl_order->StatusFinishOrder->viewAttributes() ?>>
<?php echo $tbl_order->StatusFinishOrder->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>