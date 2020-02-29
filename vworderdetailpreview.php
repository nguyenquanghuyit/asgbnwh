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
$vworderdetail_preview = new vworderdetail_preview();

// Run the page
$vworderdetail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vworderdetail_preview->Page_Render();
?>
<?php $vworderdetail_preview->showPageHeader(); ?>
<div class="card ew-grid vworderdetail"><!-- .card -->
<?php if ($vworderdetail_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$vworderdetail_preview->renderListOptions();

// Render list options (header, left)
$vworderdetail_preview->ListOptions->render("header", "left");
?>
<?php if ($vworderdetail->Code->Visible) { // Code ?>
	<?php if ($vworderdetail->SortUrl($vworderdetail->Code) == "") { ?>
		<th class="<?php echo $vworderdetail->Code->headerCellClass() ?>"><?php echo $vworderdetail->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderdetail->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderdetail->Code->Name ?>" data-sort-order="<?php echo $vworderdetail_preview->SortField == $vworderdetail->Code->Name && $vworderdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderdetail->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderdetail_preview->SortField == $vworderdetail->Code->Name) { ?><?php if ($vworderdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
	<?php if ($vworderdetail->SortUrl($vworderdetail->PCS) == "") { ?>
		<th class="<?php echo $vworderdetail->PCS->headerCellClass() ?>"><?php echo $vworderdetail->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderdetail->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderdetail->PCS->Name ?>" data-sort-order="<?php echo $vworderdetail_preview->SortField == $vworderdetail->PCS->Name && $vworderdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderdetail->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderdetail_preview->SortField == $vworderdetail->PCS->Name) { ?><?php if ($vworderdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
	<?php if ($vworderdetail->SortUrl($vworderdetail->StatusPickUp) == "") { ?>
		<th class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>"><?php echo $vworderdetail->StatusPickUp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderdetail->StatusPickUp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderdetail->StatusPickUp->Name ?>" data-sort-order="<?php echo $vworderdetail_preview->SortField == $vworderdetail->StatusPickUp->Name && $vworderdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderdetail->StatusPickUp->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderdetail_preview->SortField == $vworderdetail->StatusPickUp->Name) { ?><?php if ($vworderdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
	<?php if ($vworderdetail->SortUrl($vworderdetail->CreateUser) == "") { ?>
		<th class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>"><?php echo $vworderdetail->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderdetail->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderdetail->CreateUser->Name ?>" data-sort-order="<?php echo $vworderdetail_preview->SortField == $vworderdetail->CreateUser->Name && $vworderdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderdetail->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderdetail_preview->SortField == $vworderdetail->CreateUser->Name) { ?><?php if ($vworderdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
	<?php if ($vworderdetail->SortUrl($vworderdetail->CreateDate) == "") { ?>
		<th class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>"><?php echo $vworderdetail->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $vworderdetail->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $vworderdetail->CreateDate->Name ?>" data-sort-order="<?php echo $vworderdetail_preview->SortField == $vworderdetail->CreateDate->Name && $vworderdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $vworderdetail->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($vworderdetail_preview->SortField == $vworderdetail->CreateDate->Name) { ?><?php if ($vworderdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($vworderdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vworderdetail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$vworderdetail_preview->RecCount = 0;
$vworderdetail_preview->RowCnt = 0;
while ($vworderdetail_preview->Recordset && !$vworderdetail_preview->Recordset->EOF) {

	// Init row class and style
	$vworderdetail_preview->RecCount++;
	$vworderdetail_preview->RowCnt++;
	$vworderdetail_preview->CssStyle = "";
	$vworderdetail_preview->loadListRowValues($vworderdetail_preview->Recordset);

	// Render row
	$vworderdetail_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$vworderdetail_preview->resetAttributes();
	$vworderdetail_preview->renderListRow();

	// Render list options
	$vworderdetail_preview->renderListOptions();
?>
	<tr<?php echo $vworderdetail_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vworderdetail_preview->ListOptions->render("body", "left", $vworderdetail_preview->RowCnt);
?>
<?php if ($vworderdetail->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $vworderdetail->Code->cellAttributes() ?>>
<span<?php echo $vworderdetail->Code->viewAttributes() ?>>
<?php echo $vworderdetail->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderdetail->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $vworderdetail->PCS->cellAttributes() ?>>
<span<?php echo $vworderdetail->PCS->viewAttributes() ?>>
<?php echo $vworderdetail->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderdetail->StatusPickUp->Visible) { // StatusPickUp ?>
		<!-- StatusPickUp -->
		<td<?php echo $vworderdetail->StatusPickUp->cellAttributes() ?>>
<span<?php echo $vworderdetail->StatusPickUp->viewAttributes() ?>>
<?php echo $vworderdetail->StatusPickUp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderdetail->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $vworderdetail->CreateUser->cellAttributes() ?>>
<span<?php echo $vworderdetail->CreateUser->viewAttributes() ?>>
<?php echo $vworderdetail->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($vworderdetail->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $vworderdetail->CreateDate->cellAttributes() ?>>
<span<?php echo $vworderdetail->CreateDate->viewAttributes() ?>>
<?php echo $vworderdetail->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$vworderdetail_preview->ListOptions->render("body", "right", $vworderdetail_preview->RowCnt);
?>
	</tr>
<?php
	$vworderdetail_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($vworderdetail_preview->TotalRecs > 0) { ?>
<?php if (!isset($vworderdetail_preview->Pager)) $vworderdetail_preview->Pager = new PrevNextPager($vworderdetail_preview->StartRec, $vworderdetail_preview->DisplayRecs, $vworderdetail_preview->TotalRecs) ?>
<?php if ($vworderdetail_preview->Pager->RecordCount > 0 && $vworderdetail_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($vworderdetail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $vworderdetail_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($vworderdetail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $vworderdetail_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($vworderdetail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $vworderdetail_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($vworderdetail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $vworderdetail_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $vworderdetail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $vworderdetail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $vworderdetail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($vworderdetail_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$vworderdetail_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($vworderdetail_preview->Recordset)
	$vworderdetail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$vworderdetail_preview->terminate();
?>