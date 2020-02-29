<?php
namespace PHPMaker2019\asgbn_wh;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE, "utf-8");

// Create page object
$tbl_order_po_inv_preview = new tbl_order_po_inv_preview();

// Run the page
$tbl_order_po_inv_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_order_po_inv_preview->Page_Render();
?>
<?php $tbl_order_po_inv_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_order_po_inv"><!-- .card -->
<?php if ($tbl_order_po_inv_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_order_po_inv_preview->renderListOptions();

// Render list options (header, left)
$tbl_order_po_inv_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->Code) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>"><?php echo $tbl_order_po_inv->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->Code->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->Code->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->Code->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PalletNo) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PalletNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PalletNo->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PalletNo->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PalletNo->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PalletNo->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->DateIn) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>"><?php echo $tbl_order_po_inv->DateIn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->DateIn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->DateIn->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->DateIn->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->DateIn->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->DateIn->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PCS_In) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PCS_In->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PCS_In->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PCS_In->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_In->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PCS_In->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PCS_Out) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PCS_Out->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PCS_Out->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PCS_Out->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PCS_Out->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PCS_Out->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_No) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PO_No->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_No->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PO_No->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_No->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_No->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_No->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->INV_No) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>"><?php echo $tbl_order_po_inv->INV_No->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->INV_No->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->INV_No->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->INV_No->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->INV_No->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->INV_No->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_InputDate) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_InputDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PO_InputDate->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_InputDate->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_InputDate->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
	<?php if ($tbl_order_po_inv->SortUrl($tbl_order_po_inv->PO_InputUser) == "") { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_order_po_inv->PO_InputUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_order_po_inv->PO_InputUser->Name ?>" data-sort-order="<?php echo $tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_InputUser->Name && $tbl_order_po_inv_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_order_po_inv->PO_InputUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_order_po_inv_preview->SortField == $tbl_order_po_inv->PO_InputUser->Name) { ?><?php if ($tbl_order_po_inv_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_order_po_inv_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_order_po_inv_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_order_po_inv_preview->RecCount = 0;
$tbl_order_po_inv_preview->RowCnt = 0;
while ($tbl_order_po_inv_preview->Recordset && !$tbl_order_po_inv_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_order_po_inv_preview->RecCount++;
	$tbl_order_po_inv_preview->RowCnt++;
	$tbl_order_po_inv_preview->CssStyle = "";
	$tbl_order_po_inv_preview->loadListRowValues($tbl_order_po_inv_preview->Recordset);

	// Render row
	$tbl_order_po_inv_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_order_po_inv_preview->resetAttributes();
	$tbl_order_po_inv_preview->renderListRow();

	// Render list options
	$tbl_order_po_inv_preview->renderListOptions();
?>
	<tr<?php echo $tbl_order_po_inv_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_order_po_inv_preview->ListOptions->render("body", "left", $tbl_order_po_inv_preview->RowCnt);
?>
<?php if ($tbl_order_po_inv->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_order_po_inv->Code->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->Code->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PalletNo->Visible) { // PalletNo ?>
		<!-- PalletNo -->
		<td<?php echo $tbl_order_po_inv->PalletNo->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PalletNo->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PalletNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td<?php echo $tbl_order_po_inv->DateIn->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->DateIn->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->DateIn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_In->Visible) { // PCS_In ?>
		<!-- PCS_In -->
		<td<?php echo $tbl_order_po_inv->PCS_In->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PCS_In->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_In->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PCS_Out->Visible) { // PCS_Out ?>
		<!-- PCS_Out -->
		<td<?php echo $tbl_order_po_inv->PCS_Out->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PCS_Out->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PCS_Out->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_No->Visible) { // PO_No ?>
		<!-- PO_No -->
		<td<?php echo $tbl_order_po_inv->PO_No->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PO_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_No->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->INV_No->Visible) { // INV_No ?>
		<!-- INV_No -->
		<td<?php echo $tbl_order_po_inv->INV_No->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->INV_No->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->INV_No->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputDate->Visible) { // PO_InputDate ?>
		<!-- PO_InputDate -->
		<td<?php echo $tbl_order_po_inv->PO_InputDate->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PO_InputDate->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_order_po_inv->PO_InputUser->Visible) { // PO_InputUser ?>
		<!-- PO_InputUser -->
		<td<?php echo $tbl_order_po_inv->PO_InputUser->cellAttributes() ?>>
<span<?php echo $tbl_order_po_inv->PO_InputUser->viewAttributes() ?>>
<?php echo $tbl_order_po_inv->PO_InputUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_order_po_inv_preview->ListOptions->render("body", "right", $tbl_order_po_inv_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_order_po_inv_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_order_po_inv_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_order_po_inv_preview->Pager)) $tbl_order_po_inv_preview->Pager = new PrevNextPager($tbl_order_po_inv_preview->StartRec, $tbl_order_po_inv_preview->DisplayRecs, $tbl_order_po_inv_preview->TotalRecs) ?>
<?php if ($tbl_order_po_inv_preview->Pager->RecordCount > 0 && $tbl_order_po_inv_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_order_po_inv_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_order_po_inv_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_order_po_inv_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_order_po_inv_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_order_po_inv_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_order_po_inv_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_order_po_inv_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_order_po_inv_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_order_po_inv_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_order_po_inv_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_order_po_inv_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_order_po_inv_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_order_po_inv_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_order_po_inv_preview->Recordset)
	$tbl_order_po_inv_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_order_po_inv_preview->terminate();
?>