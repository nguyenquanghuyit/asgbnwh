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
$tbl_loading_preview = new tbl_loading_preview();

// Run the page
$tbl_loading_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_loading_preview->Page_Render();
?>
<?php $tbl_loading_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_loading"><!-- .card -->
<?php if ($tbl_loading_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_loading_preview->renderListOptions();

// Render list options (header, left)
$tbl_loading_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->ID_Order) == "") { ?>
		<th class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>"><?php echo $tbl_loading->ID_Order->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->ID_Order->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->ID_Order->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->ID_Order->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->ID_Order->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->ID_Order->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->CusomterOrderNo) == "") { ?>
		<th class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->CusomterOrderNo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->CusomterOrderNo->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->CusomterOrderNo->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->CusomterOrderNo->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->CusomterOrderNo->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->CreateUser) == "") { ?>
		<th class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>"><?php echo $tbl_loading->CreateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->CreateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->CreateUser->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->CreateUser->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->CreateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->CreateUser->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->CreateDate) == "") { ?>
		<th class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>"><?php echo $tbl_loading->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->CreateDate->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->CreateDate->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->CreateDate->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->UpdateUser) == "") { ?>
		<th class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>"><?php echo $tbl_loading->UpdateUser->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->UpdateUser->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->UpdateUser->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->UpdateUser->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateUser->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->UpdateUser->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
	<?php if ($tbl_loading->SortUrl($tbl_loading->UpdateDate) == "") { ?>
		<th class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>"><?php echo $tbl_loading->UpdateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_loading->UpdateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_loading->UpdateDate->Name ?>" data-sort-order="<?php echo $tbl_loading_preview->SortField == $tbl_loading->UpdateDate->Name && $tbl_loading_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_loading->UpdateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_loading_preview->SortField == $tbl_loading->UpdateDate->Name) { ?><?php if ($tbl_loading_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_loading_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_loading_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_loading_preview->RecCount = 0;
$tbl_loading_preview->RowCnt = 0;
while ($tbl_loading_preview->Recordset && !$tbl_loading_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_loading_preview->RecCount++;
	$tbl_loading_preview->RowCnt++;
	$tbl_loading_preview->CssStyle = "";
	$tbl_loading_preview->loadListRowValues($tbl_loading_preview->Recordset);

	// Render row
	$tbl_loading_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_loading_preview->resetAttributes();
	$tbl_loading_preview->renderListRow();

	// Render list options
	$tbl_loading_preview->renderListOptions();
?>
	<tr<?php echo $tbl_loading_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_loading_preview->ListOptions->render("body", "left", $tbl_loading_preview->RowCnt);
?>
<?php if ($tbl_loading->ID_Order->Visible) { // ID_Order ?>
		<!-- ID_Order -->
		<td<?php echo $tbl_loading->ID_Order->cellAttributes() ?>>
<span<?php echo $tbl_loading->ID_Order->viewAttributes() ?>>
<?php echo $tbl_loading->ID_Order->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_loading->CusomterOrderNo->Visible) { // CusomterOrderNo ?>
		<!-- CusomterOrderNo -->
		<td<?php echo $tbl_loading->CusomterOrderNo->cellAttributes() ?>>
<span<?php echo $tbl_loading->CusomterOrderNo->viewAttributes() ?>>
<?php echo $tbl_loading->CusomterOrderNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_loading->CreateUser->Visible) { // CreateUser ?>
		<!-- CreateUser -->
		<td<?php echo $tbl_loading->CreateUser->cellAttributes() ?>>
<span<?php echo $tbl_loading->CreateUser->viewAttributes() ?>>
<?php echo $tbl_loading->CreateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_loading->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $tbl_loading->CreateDate->cellAttributes() ?>>
<span<?php echo $tbl_loading->CreateDate->viewAttributes() ?>>
<?php echo $tbl_loading->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_loading->UpdateUser->Visible) { // UpdateUser ?>
		<!-- UpdateUser -->
		<td<?php echo $tbl_loading->UpdateUser->cellAttributes() ?>>
<span<?php echo $tbl_loading->UpdateUser->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateUser->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_loading->UpdateDate->Visible) { // UpdateDate ?>
		<!-- UpdateDate -->
		<td<?php echo $tbl_loading->UpdateDate->cellAttributes() ?>>
<span<?php echo $tbl_loading->UpdateDate->viewAttributes() ?>>
<?php echo $tbl_loading->UpdateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_loading_preview->ListOptions->render("body", "right", $tbl_loading_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_loading_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_loading_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_loading_preview->Pager)) $tbl_loading_preview->Pager = new PrevNextPager($tbl_loading_preview->StartRec, $tbl_loading_preview->DisplayRecs, $tbl_loading_preview->TotalRecs) ?>
<?php if ($tbl_loading_preview->Pager->RecordCount > 0 && $tbl_loading_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_loading_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_loading_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_loading_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_loading_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_loading_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_loading_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_loading_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_loading_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_loading_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_loading_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_loading_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_loading_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_loading_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_loading_preview->Recordset)
	$tbl_loading_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_loading_preview->terminate();
?>