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
$tbl_orderguide_preview = new tbl_orderguide_preview();

// Run the page
$tbl_orderguide_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_orderguide_preview->Page_Render();
?>
<?php $tbl_orderguide_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_orderguide"><!-- .card -->
<?php if ($tbl_orderguide_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_orderguide_preview->renderListOptions();

// Render list options (header, left)
$tbl_orderguide_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->Code) == "") { ?>
		<th class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>"><?php echo $tbl_orderguide->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->Code->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->Code->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->Code->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->ProductName) == "") { ?>
		<th class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>"><?php echo $tbl_orderguide->ProductName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->ProductName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->ProductName->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->ProductName->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->ProductName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->ProductName->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->PCS_In) == "") { ?>
		<th class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>"><?php echo $tbl_orderguide->PCS_In->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->PCS_In->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->PCS_In->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->PCS_In->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS_In->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->PCS_In->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->PCS) == "") { ?>
		<th class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>"><?php echo $tbl_orderguide->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->PCS->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->PCS->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->PCS->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->Qty) == "") { ?>
		<th class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>"><?php echo $tbl_orderguide->Qty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->Qty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->Qty->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->Qty->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->Qty->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->Qty->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->Box) == "") { ?>
		<th class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>"><?php echo $tbl_orderguide->Box->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->Box->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->Box->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->Box->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->Box->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->Box->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->ID_Location) == "") { ?>
		<th class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>"><?php echo $tbl_orderguide->ID_Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->ID_Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->ID_Location->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->ID_Location->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->ID_Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->ID_Location->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->PalletID) == "") { ?>
		<th class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>"><?php echo $tbl_orderguide->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->PalletID->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->PalletID->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->PalletID->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->MFG) == "") { ?>
		<th class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>"><?php echo $tbl_orderguide->MFG->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->MFG->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->MFG->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->MFG->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->MFG->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->MFG->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->DateIn) == "") { ?>
		<th class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>"><?php echo $tbl_orderguide->DateIn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->DateIn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->DateIn->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->DateIn->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->DateIn->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->DateIn->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
	<?php if ($tbl_orderguide->SortUrl($tbl_orderguide->CreateDate) == "") { ?>
		<th class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>"><?php echo $tbl_orderguide->CreateDate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_orderguide->CreateDate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_orderguide->CreateDate->Name ?>" data-sort-order="<?php echo $tbl_orderguide_preview->SortField == $tbl_orderguide->CreateDate->Name && $tbl_orderguide_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_orderguide->CreateDate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_orderguide_preview->SortField == $tbl_orderguide->CreateDate->Name) { ?><?php if ($tbl_orderguide_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_orderguide_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_orderguide_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_orderguide_preview->RecCount = 0;
$tbl_orderguide_preview->RowCnt = 0;
while ($tbl_orderguide_preview->Recordset && !$tbl_orderguide_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_orderguide_preview->RecCount++;
	$tbl_orderguide_preview->RowCnt++;
	$tbl_orderguide_preview->CssStyle = "";
	$tbl_orderguide_preview->loadListRowValues($tbl_orderguide_preview->Recordset);

	// Render row
	$tbl_orderguide_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_orderguide_preview->resetAttributes();
	$tbl_orderguide_preview->renderListRow();

	// Render list options
	$tbl_orderguide_preview->renderListOptions();
?>
	<tr<?php echo $tbl_orderguide_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_orderguide_preview->ListOptions->render("body", "left", $tbl_orderguide_preview->RowCnt);
?>
<?php if ($tbl_orderguide->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_orderguide->Code->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->Code->viewAttributes() ?>>
<?php echo $tbl_orderguide->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->ProductName->Visible) { // ProductName ?>
		<!-- ProductName -->
		<td<?php echo $tbl_orderguide->ProductName->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->ProductName->viewAttributes() ?>>
<?php echo $tbl_orderguide->ProductName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PCS_In->Visible) { // PCS_In ?>
		<!-- PCS_In -->
		<td<?php echo $tbl_orderguide->PCS_In->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->PCS_In->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS_In->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_orderguide->PCS->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->PCS->viewAttributes() ?>>
<?php echo $tbl_orderguide->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->Qty->Visible) { // Qty ?>
		<!-- Qty -->
		<td<?php echo $tbl_orderguide->Qty->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->Qty->viewAttributes() ?>>
<?php echo $tbl_orderguide->Qty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->Box->Visible) { // Box ?>
		<!-- Box -->
		<td<?php echo $tbl_orderguide->Box->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->Box->viewAttributes() ?>>
<?php echo $tbl_orderguide->Box->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->ID_Location->Visible) { // ID_Location ?>
		<!-- ID_Location -->
		<td<?php echo $tbl_orderguide->ID_Location->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->ID_Location->viewAttributes() ?>>
<?php echo $tbl_orderguide->ID_Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $tbl_orderguide->PalletID->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->PalletID->viewAttributes() ?>>
<?php echo $tbl_orderguide->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->MFG->Visible) { // MFG ?>
		<!-- MFG -->
		<td<?php echo $tbl_orderguide->MFG->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->MFG->viewAttributes() ?>>
<?php echo $tbl_orderguide->MFG->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td<?php echo $tbl_orderguide->DateIn->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->DateIn->viewAttributes() ?>>
<?php echo $tbl_orderguide->DateIn->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_orderguide->CreateDate->Visible) { // CreateDate ?>
		<!-- CreateDate -->
		<td<?php echo $tbl_orderguide->CreateDate->cellAttributes() ?>>
<span<?php echo $tbl_orderguide->CreateDate->viewAttributes() ?>>
<?php echo $tbl_orderguide->CreateDate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_orderguide_preview->ListOptions->render("body", "right", $tbl_orderguide_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_orderguide_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_orderguide_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_orderguide_preview->Pager)) $tbl_orderguide_preview->Pager = new PrevNextPager($tbl_orderguide_preview->StartRec, $tbl_orderguide_preview->DisplayRecs, $tbl_orderguide_preview->TotalRecs) ?>
<?php if ($tbl_orderguide_preview->Pager->RecordCount > 0 && $tbl_orderguide_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_orderguide_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_orderguide_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_orderguide_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_orderguide_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_orderguide_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_orderguide_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_orderguide_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_orderguide_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_orderguide_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_orderguide_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_orderguide_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_orderguide_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_orderguide_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_orderguide_preview->Recordset)
	$tbl_orderguide_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_orderguide_preview->terminate();
?>