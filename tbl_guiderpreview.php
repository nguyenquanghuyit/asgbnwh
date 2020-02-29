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
$tbl_guider_preview = new tbl_guider_preview();

// Run the page
$tbl_guider_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_guider_preview->Page_Render();
?>
<?php $tbl_guider_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_guider"><!-- .card -->
<?php if ($tbl_guider_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_guider_preview->renderListOptions();

// Render list options (header, left)
$tbl_guider_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_guider->Code->Visible) { // Code ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->Code) == "") { ?>
		<th class="<?php echo $tbl_guider->Code->headerCellClass() ?>"><?php echo $tbl_guider->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->Code->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->Code->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->Code->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->ProductName) == "") { ?>
		<th class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>"><?php echo $tbl_guider->ProductName->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->ProductName->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->ProductName->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->ProductName->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->ProductName->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->ProductName->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->PCS_Request) == "") { ?>
		<th class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>"><?php echo $tbl_guider->PCS_Request->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->PCS_Request->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->PCS_Request->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->PCS_Request->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_Request->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->PCS_Request->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->ID_Location) == "") { ?>
		<th class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>"><?php echo $tbl_guider->ID_Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->ID_Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->ID_Location->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->ID_Location->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->ID_Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->ID_Location->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->PCS_In) == "") { ?>
		<th class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>"><?php echo $tbl_guider->PCS_In->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->PCS_In->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->PCS_In->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->PCS_In->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->PCS_In->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->PCS_In->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->PCS) == "") { ?>
		<th class="<?php echo $tbl_guider->PCS->headerCellClass() ?>"><?php echo $tbl_guider->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->PCS->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->PCS->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->PCS->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->PalletID) == "") { ?>
		<th class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>"><?php echo $tbl_guider->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->PalletID->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->PalletID->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->PalletID->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
	<?php if ($tbl_guider->SortUrl($tbl_guider->DateIn) == "") { ?>
		<th class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>"><?php echo $tbl_guider->DateIn->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_guider->DateIn->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_guider->DateIn->Name ?>" data-sort-order="<?php echo $tbl_guider_preview->SortField == $tbl_guider->DateIn->Name && $tbl_guider_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_guider->DateIn->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_guider_preview->SortField == $tbl_guider->DateIn->Name) { ?><?php if ($tbl_guider_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_guider_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_guider_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_guider_preview->RecCount = 0;
$tbl_guider_preview->RowCnt = 0;
while ($tbl_guider_preview->Recordset && !$tbl_guider_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_guider_preview->RecCount++;
	$tbl_guider_preview->RowCnt++;
	$tbl_guider_preview->CssStyle = "";
	$tbl_guider_preview->loadListRowValues($tbl_guider_preview->Recordset);

	// Render row
	$tbl_guider_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_guider_preview->resetAttributes();
	$tbl_guider_preview->renderListRow();

	// Render list options
	$tbl_guider_preview->renderListOptions();
?>
	<tr<?php echo $tbl_guider_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_guider_preview->ListOptions->render("body", "left", $tbl_guider_preview->RowCnt);
?>
<?php if ($tbl_guider->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_guider->Code->cellAttributes() ?>>
<span<?php echo $tbl_guider->Code->viewAttributes() ?>>
<?php echo $tbl_guider->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->ProductName->Visible) { // ProductName ?>
		<!-- ProductName -->
		<td<?php echo $tbl_guider->ProductName->cellAttributes() ?>>
<span<?php echo $tbl_guider->ProductName->viewAttributes() ?>>
<?php echo $tbl_guider->ProductName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS_Request->Visible) { // PCS_Request ?>
		<!-- PCS_Request -->
		<td<?php echo $tbl_guider->PCS_Request->cellAttributes() ?>>
<span<?php echo $tbl_guider->PCS_Request->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_Request->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->ID_Location->Visible) { // ID_Location ?>
		<!-- ID_Location -->
		<td<?php echo $tbl_guider->ID_Location->cellAttributes() ?>>
<span<?php echo $tbl_guider->ID_Location->viewAttributes() ?>>
<?php echo $tbl_guider->ID_Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS_In->Visible) { // PCS_In ?>
		<!-- PCS_In -->
		<td<?php echo $tbl_guider->PCS_In->cellAttributes() ?>>
<span<?php echo $tbl_guider->PCS_In->viewAttributes() ?>>
<?php echo $tbl_guider->PCS_In->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_guider->PCS->cellAttributes() ?>>
<span<?php echo $tbl_guider->PCS->viewAttributes() ?>>
<?php echo $tbl_guider->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $tbl_guider->PalletID->cellAttributes() ?>>
<span<?php echo $tbl_guider->PalletID->viewAttributes() ?>>
<?php echo $tbl_guider->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_guider->DateIn->Visible) { // DateIn ?>
		<!-- DateIn -->
		<td<?php echo $tbl_guider->DateIn->cellAttributes() ?>>
<span<?php echo $tbl_guider->DateIn->viewAttributes() ?>>
<?php echo $tbl_guider->DateIn->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_guider_preview->ListOptions->render("body", "right", $tbl_guider_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_guider_preview->Recordset->MoveNext();
}
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_guider_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_guider_preview->Pager)) $tbl_guider_preview->Pager = new PrevNextPager($tbl_guider_preview->StartRec, $tbl_guider_preview->DisplayRecs, $tbl_guider_preview->TotalRecs) ?>
<?php if ($tbl_guider_preview->Pager->RecordCount > 0 && $tbl_guider_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_guider_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_guider_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_guider_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_guider_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_guider_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_guider_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_guider_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_guider_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_guider_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_guider_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_guider_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_guider_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_guider_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_guider_preview->Recordset)
	$tbl_guider_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_guider_preview->terminate();
?>