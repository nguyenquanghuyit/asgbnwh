<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_product->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_productmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_product->IdType->Visible) { // IdType ?>
		<tr id="r_IdType">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->IdType->caption() ?></td>
			<td<?php echo $tbl_product->IdType->cellAttributes() ?>>
<span id="el_tbl_product_IdType">
<span<?php echo $tbl_product->IdType->viewAttributes() ?>>
<?php echo $tbl_product->IdType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->Code->Visible) { // Code ?>
		<tr id="r_Code">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->Code->caption() ?></td>
			<td<?php echo $tbl_product->Code->cellAttributes() ?>>
<span id="el_tbl_product_Code">
<span<?php echo $tbl_product->Code->viewAttributes() ?>>
<?php echo $tbl_product->Code->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->Model->Visible) { // Model ?>
		<tr id="r_Model">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->Model->caption() ?></td>
			<td<?php echo $tbl_product->Model->cellAttributes() ?>>
<span id="el_tbl_product_Model">
<span<?php echo $tbl_product->Model->viewAttributes() ?>>
<?php echo $tbl_product->Model->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->ProductName->Visible) { // ProductName ?>
		<tr id="r_ProductName">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->ProductName->caption() ?></td>
			<td<?php echo $tbl_product->ProductName->cellAttributes() ?>>
<span id="el_tbl_product_ProductName">
<span<?php echo $tbl_product->ProductName->viewAttributes() ?>>
<?php echo $tbl_product->ProductName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->VnName->Visible) { // VnName ?>
		<tr id="r_VnName">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->VnName->caption() ?></td>
			<td<?php echo $tbl_product->VnName->cellAttributes() ?>>
<span id="el_tbl_product_VnName">
<span<?php echo $tbl_product->VnName->viewAttributes() ?>>
<?php echo $tbl_product->VnName->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->ID_Contact->Visible) { // ID_Contact ?>
		<tr id="r_ID_Contact">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->ID_Contact->caption() ?></td>
			<td<?php echo $tbl_product->ID_Contact->cellAttributes() ?>>
<span id="el_tbl_product_ID_Contact">
<span<?php echo $tbl_product->ID_Contact->viewAttributes() ?>>
<?php echo $tbl_product->ID_Contact->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->Description->Visible) { // Description ?>
		<tr id="r_Description">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->Description->caption() ?></td>
			<td<?php echo $tbl_product->Description->cellAttributes() ?>>
<span id="el_tbl_product_Description">
<span<?php echo $tbl_product->Description->viewAttributes() ?>>
<?php echo $tbl_product->Description->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->CreateDate->Visible) { // CreateDate ?>
		<tr id="r_CreateDate">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->CreateDate->caption() ?></td>
			<td<?php echo $tbl_product->CreateDate->cellAttributes() ?>>
<span id="el_tbl_product_CreateDate">
<span<?php echo $tbl_product->CreateDate->viewAttributes() ?>>
<?php echo $tbl_product->CreateDate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_product->CreateUser->Visible) { // CreateUser ?>
		<tr id="r_CreateUser">
			<td class="<?php echo $tbl_product->TableLeftColumnClass ?>"><?php echo $tbl_product->CreateUser->caption() ?></td>
			<td<?php echo $tbl_product->CreateUser->cellAttributes() ?>>
<span id="el_tbl_product_CreateUser">
<span<?php echo $tbl_product->CreateUser->viewAttributes() ?>>
<?php echo $tbl_product->CreateUser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>