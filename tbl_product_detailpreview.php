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
$tbl_product_detail_preview = new tbl_product_detail_preview();

// Run the page
$tbl_product_detail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_product_detail_preview->Page_Render();
?>
<?php $tbl_product_detail_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_product_detail"><!-- .card -->
<?php if ($tbl_product_detail_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_product_detail_preview->renderListOptions();

// Render list options (header, left)
$tbl_product_detail_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
	<?php if ($tbl_product_detail->SortUrl($tbl_product_detail->PackingQty) == "") { ?>
		<th class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>"><?php echo $tbl_product_detail->PackingQty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_product_detail->PackingQty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_product_detail->PackingQty->Name ?>" data-sort-order="<?php echo $tbl_product_detail_preview->SortField == $tbl_product_detail->PackingQty->Name && $tbl_product_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_product_detail->PackingQty->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_product_detail_preview->SortField == $tbl_product_detail->PackingQty->Name) { ?><?php if ($tbl_product_detail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_product_detail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
	<?php if ($tbl_product_detail->SortUrl($tbl_product_detail->IdUnit) == "") { ?>
		<th class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><?php echo $tbl_product_detail->IdUnit->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_product_detail->IdUnit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_product_detail->IdUnit->Name ?>" data-sort-order="<?php echo $tbl_product_detail_preview->SortField == $tbl_product_detail->IdUnit->Name && $tbl_product_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_product_detail->IdUnit->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_product_detail_preview->SortField == $tbl_product_detail->IdUnit->Name) { ?><?php if ($tbl_product_detail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_product_detail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
	<?php if ($tbl_product_detail->SortUrl($tbl_product_detail->DefaultCode) == "") { ?>
		<th class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>"><?php echo $tbl_product_detail->DefaultCode->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_product_detail->DefaultCode->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_product_detail->DefaultCode->Name ?>" data-sort-order="<?php echo $tbl_product_detail_preview->SortField == $tbl_product_detail->DefaultCode->Name && $tbl_product_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_product_detail->DefaultCode->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_product_detail_preview->SortField == $tbl_product_detail->DefaultCode->Name) { ?><?php if ($tbl_product_detail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_product_detail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_product_detail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_product_detail_preview->RecCount = 0;
$tbl_product_detail_preview->RowCnt = 0;
while ($tbl_product_detail_preview->Recordset && !$tbl_product_detail_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_product_detail_preview->RecCount++;
	$tbl_product_detail_preview->RowCnt++;
	$tbl_product_detail_preview->CssStyle = "";
	$tbl_product_detail_preview->loadListRowValues($tbl_product_detail_preview->Recordset);

	// Render row
	$tbl_product_detail_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_product_detail_preview->resetAttributes();
	$tbl_product_detail_preview->renderListRow();

	// Render list options
	$tbl_product_detail_preview->renderListOptions();
?>
	<tr<?php echo $tbl_product_detail_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_product_detail_preview->ListOptions->render("body", "left", $tbl_product_detail_preview->RowCnt);
?>
<?php if ($tbl_product_detail->PackingQty->Visible) { // PackingQty ?>
		<!-- PackingQty -->
		<td<?php echo $tbl_product_detail->PackingQty->cellAttributes() ?>>
<span<?php echo $tbl_product_detail->PackingQty->viewAttributes() ?>>
<?php echo $tbl_product_detail->PackingQty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_product_detail->IdUnit->Visible) { // IdUnit ?>
		<!-- IdUnit -->
		<td<?php echo $tbl_product_detail->IdUnit->cellAttributes() ?>>
<span<?php echo $tbl_product_detail->IdUnit->viewAttributes() ?>>
<?php echo $tbl_product_detail->IdUnit->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_product_detail->DefaultCode->Visible) { // DefaultCode ?>
		<!-- DefaultCode -->
		<td<?php echo $tbl_product_detail->DefaultCode->cellAttributes() ?>>
<span<?php echo $tbl_product_detail->DefaultCode->viewAttributes() ?>>
<?php echo $tbl_product_detail->DefaultCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_product_detail_preview->ListOptions->render("body", "right", $tbl_product_detail_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_product_detail_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_product_detail_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_product_detail_preview->Pager)) $tbl_product_detail_preview->Pager = new PrevNextPager($tbl_product_detail_preview->StartRec, $tbl_product_detail_preview->DisplayRecs, $tbl_product_detail_preview->TotalRecs) ?>
<?php if ($tbl_product_detail_preview->Pager->RecordCount > 0 && $tbl_product_detail_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_product_detail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_product_detail_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_product_detail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_product_detail_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_product_detail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_product_detail_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_product_detail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_product_detail_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_product_detail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_product_detail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_product_detail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_product_detail_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_product_detail_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_product_detail_preview->Recordset)
	$tbl_product_detail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_product_detail_preview->terminate();
?>