<?php
namespace PHPMaker2019\asgbn_wh;
?>
<?php if ($vwmasterguide->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_vwmasterguidemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($vwmasterguide->ID_Order->Visible) { // ID_Order ?>
		<tr id="r_ID_Order">
			<td class="<?php echo $vwmasterguide->TableLeftColumnClass ?>"><?php echo $vwmasterguide->ID_Order->caption() ?></td>
			<td<?php echo $vwmasterguide->ID_Order->cellAttributes() ?>>
<span id="el_vwmasterguide_ID_Order">
<span<?php echo $vwmasterguide->ID_Order->viewAttributes() ?>>
<?php echo $vwmasterguide->ID_Order->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>