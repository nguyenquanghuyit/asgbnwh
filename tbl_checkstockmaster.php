<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($tbl_checkstock->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_tbl_checkstockmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($tbl_checkstock->tenDotKiemKho->Visible) { // tenDotKiemKho ?>
		<tr id="r_tenDotKiemKho">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->tenDotKiemKho->caption() ?></td>
			<td<?php echo $tbl_checkstock->tenDotKiemKho->cellAttributes() ?>>
<span id="el_tbl_checkstock_tenDotKiemKho">
<span<?php echo $tbl_checkstock->tenDotKiemKho->viewAttributes() ?>>
<?php echo $tbl_checkstock->tenDotKiemKho->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_checkstock->NoiDung->Visible) { // NoiDung ?>
		<tr id="r_NoiDung">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->NoiDung->caption() ?></td>
			<td<?php echo $tbl_checkstock->NoiDung->cellAttributes() ?>>
<span id="el_tbl_checkstock_NoiDung">
<span<?php echo $tbl_checkstock->NoiDung->viewAttributes() ?>>
<?php echo $tbl_checkstock->NoiDung->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_checkstock->UserCreate->Visible) { // UserCreate ?>
		<tr id="r_UserCreate">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->UserCreate->caption() ?></td>
			<td<?php echo $tbl_checkstock->UserCreate->cellAttributes() ?>>
<span id="el_tbl_checkstock_UserCreate">
<span<?php echo $tbl_checkstock->UserCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserCreate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<tr id="r_DatetimeCreate">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->DatetimeCreate->caption() ?></td>
			<td<?php echo $tbl_checkstock->DatetimeCreate->cellAttributes() ?>>
<span id="el_tbl_checkstock_DatetimeCreate">
<span<?php echo $tbl_checkstock->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeCreate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_checkstock->UserUpdate->Visible) { // UserUpdate ?>
		<tr id="r_UserUpdate">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->UserUpdate->caption() ?></td>
			<td<?php echo $tbl_checkstock->UserUpdate->cellAttributes() ?>>
<span id="el_tbl_checkstock_UserUpdate">
<span<?php echo $tbl_checkstock->UserUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->UserUpdate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($tbl_checkstock->DatetimeUpdate->Visible) { // DatetimeUpdate ?>
		<tr id="r_DatetimeUpdate">
			<td class="<?php echo $tbl_checkstock->TableLeftColumnClass ?>"><?php echo $tbl_checkstock->DatetimeUpdate->caption() ?></td>
			<td<?php echo $tbl_checkstock->DatetimeUpdate->cellAttributes() ?>>
<span id="el_tbl_checkstock_DatetimeUpdate">
<span<?php echo $tbl_checkstock->DatetimeUpdate->viewAttributes() ?>>
<?php echo $tbl_checkstock->DatetimeUpdate->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>