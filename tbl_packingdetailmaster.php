<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_packingdetail->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_packingdetailmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_packingdetail->ID_packingDetail->Visible) { // ID_packingDetail ?>
		<tr id="r_ID_packingDetail">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->ID_packingDetail->caption() ?></td>
			<td<?php echo $tbl_packingdetail->ID_packingDetail->cellAttributes() ?>>
<span id="el_tbl_packingdetail_ID_packingDetail">
<span<?php echo $tbl_packingdetail->ID_packingDetail->viewAttributes() ?>>
<?php echo $tbl_packingdetail->ID_packingDetail->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->PackingOrNoPacking->Visible) { // PackingOrNoPacking ?>
		<tr id="r_PackingOrNoPacking">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->PackingOrNoPacking->caption() ?></td>
			<td<?php echo $tbl_packingdetail->PackingOrNoPacking->cellAttributes() ?>>
<span id="el_tbl_packingdetail_PackingOrNoPacking">
<span<?php echo $tbl_packingdetail->PackingOrNoPacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingOrNoPacking->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->PackingType->Visible) { // PackingType ?>
		<tr id="r_PackingType">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->PackingType->caption() ?></td>
			<td<?php echo $tbl_packingdetail->PackingType->cellAttributes() ?>>
<span id="el_tbl_packingdetail_PackingType">
<span<?php echo $tbl_packingdetail->PackingType->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PackingType->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Length->Visible) { // Length ?>
		<tr id="r_Length">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->Length->caption() ?></td>
			<td<?php echo $tbl_packingdetail->Length->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Length">
<span<?php echo $tbl_packingdetail->Length->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Length->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Width->Visible) { // Width ?>
		<tr id="r_Width">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->Width->caption() ?></td>
			<td<?php echo $tbl_packingdetail->Width->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Width">
<span<?php echo $tbl_packingdetail->Width->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Width->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->Heigth->Visible) { // Heigth ?>
		<tr id="r_Heigth">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->Heigth->caption() ?></td>
			<td<?php echo $tbl_packingdetail->Heigth->cellAttributes() ?>>
<span id="el_tbl_packingdetail_Heigth">
<span<?php echo $tbl_packingdetail->Heigth->viewAttributes() ?>>
<?php echo $tbl_packingdetail->Heigth->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->PE_film_Cover->Visible) { // PE_film_Cover ?>
		<tr id="r_PE_film_Cover">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->PE_film_Cover->caption() ?></td>
			<td<?php echo $tbl_packingdetail->PE_film_Cover->cellAttributes() ?>>
<span id="el_tbl_packingdetail_PE_film_Cover">
<span<?php echo $tbl_packingdetail->PE_film_Cover->viewAttributes() ?>>
<?php echo $tbl_packingdetail->PE_film_Cover->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_packingdetail->finishpacking->Visible) { // finishpacking ?>
		<tr id="r_finishpacking">
			<td class="<?php echo $tbl_packingdetail->TableLeftColumnClass ?>"><?php echo $tbl_packingdetail->finishpacking->caption() ?></td>
			<td<?php echo $tbl_packingdetail->finishpacking->cellAttributes() ?>>
<span id="el_tbl_packingdetail_finishpacking">
<span<?php echo $tbl_packingdetail->finishpacking->viewAttributes() ?>>
<?php echo $tbl_packingdetail->finishpacking->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>