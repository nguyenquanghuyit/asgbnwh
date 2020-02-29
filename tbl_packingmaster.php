<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_packing->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_packingmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_packing->Id_order->Visible) { // Id_order ?>
		<tr id="r_Id_order">
			<td class="<?php echo $tbl_packing->TableLeftColumnClass ?>"><?php echo $tbl_packing->Id_order->caption() ?></td>
			<td<?php echo $tbl_packing->Id_order->cellAttributes() ?>>
<span id="el_tbl_packing_Id_order">
<span<?php echo $tbl_packing->Id_order->viewAttributes() ?>>
<?php echo $tbl_packing->Id_order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packing->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $tbl_packing->TableLeftColumnClass ?>"><?php echo $tbl_packing->CreateUser->caption() ?></td>
			<td<?php echo $tbl_packing->CreateUser->cellAttributes() ?>>
<span id="el_tbl_packing_CreateUser">
<span<?php echo $tbl_packing->CreateUser->viewAttributes() ?>>
<?php echo $tbl_packing->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packing->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $tbl_packing->TableLeftColumnClass ?>"><?php echo $tbl_packing->CreateDate->caption() ?></td>
			<td<?php echo $tbl_packing->CreateDate->cellAttributes() ?>>
<span id="el_tbl_packing_CreateDate">
<span<?php echo $tbl_packing->CreateDate->viewAttributes() ?>>
<?php echo $tbl_packing->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>