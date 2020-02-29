<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($packing->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_packingmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($packing->ID_Order->Visible) { // ID_Order ?>
		<tr id="r_ID_Order">
			<td class="<?php echo $packing->TableLeftColumnClass ?>"><?php echo $packing->ID_Order->caption() ?></td>
			<td<?php echo $packing->ID_Order->cellAttributes() ?>>
<span id="el_packing_ID_Order">
<span<?php echo $packing->ID_Order->viewAttributes() ?>>
<?php echo $packing->ID_Order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($packing->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<tr id="r_CusomterOrderNo">
			<td class="<?php echo $packing->TableLeftColumnClass ?>"><?php echo $packing->CusomterOrderNo->caption() ?></td>
			<td<?php echo $packing->CusomterOrderNo->cellAttributes() ?>>
<span id="el_packing_CusomterOrderNo">
<span<?php echo $packing->CusomterOrderNo->viewAttributes() ?>>
<?php echo $packing->CusomterOrderNo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($packing->TypeName->Visible) { // TypeName ?>
		<tr id="r_TypeName">
			<td class="<?php echo $packing->TableLeftColumnClass ?>"><?php echo $packing->TypeName->caption() ?></td>
			<td<?php echo $packing->TypeName->cellAttributes() ?>>
<span id="el_packing_TypeName">
<span<?php echo $packing->TypeName->viewAttributes() ?>>
<?php echo $packing->TypeName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($packing->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $packing->TableLeftColumnClass ?>"><?php echo $packing->CreateUser->caption() ?></td>
			<td<?php echo $packing->CreateUser->cellAttributes() ?>>
<span id="el_packing_CreateUser">
<span<?php echo $packing->CreateUser->viewAttributes() ?>>
<?php echo $packing->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($packing->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $packing->TableLeftColumnClass ?>"><?php echo $packing->CreateDate->caption() ?></td>
			<td<?php echo $packing->CreateDate->cellAttributes() ?>>
<span id="el_packing_CreateDate">
<span<?php echo $packing->CreateDate->viewAttributes() ?>>
<?php echo $packing->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>