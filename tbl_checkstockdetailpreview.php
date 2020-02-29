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
$tbl_checkstockdetail_preview = new tbl_checkstockdetail_preview();

// Run the page
$tbl_checkstockdetail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tbl_checkstockdetail_preview->Page_Render();
?>
<?php $tbl_checkstockdetail_preview->showPageHeader(); ?>
<div class="card ew-grid tbl_checkstockdetail"><!-- .card -->
<?php if ($tbl_checkstockdetail_preview->TotalRecs > 0) { ?>
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$tbl_checkstockdetail_preview->renderListOptions();

// Render list options (header, left)
$tbl_checkstockdetail_preview->ListOptions->render("header", "left");
?>
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Location) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->Location->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->Location->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->Location->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Location->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Location->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Location->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->PalletID) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->PalletID->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->PalletID->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->PalletID->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PalletID->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->PalletID->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Code) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->Code->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->Code->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->Code->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Code->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Code->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Code->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->PCS) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->PCS->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->PCS->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->PCS->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->PCS->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->PCS->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->PCS->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->DateTimeCheck) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->DateTimeCheck->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->DateTimeCheck->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->DateTimeCheck->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DateTimeCheck->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->DateTimeCheck->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->UserCheck) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->UserCheck->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->UserCheck->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->UserCheck->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->UserCheck->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->UserCheck->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->Usercreate) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->Usercreate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->Usercreate->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Usercreate->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->Usercreate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->Usercreate->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
	<?php if ($tbl_checkstockdetail->SortUrl($tbl_checkstockdetail->DatetimeCreate) == "") { ?>
		<th class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $tbl_checkstockdetail->DatetimeCreate->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo $tbl_checkstockdetail->DatetimeCreate->Name ?>" data-sort-order="<?php echo $tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->DatetimeCreate->Name && $tbl_checkstockdetail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>"><div class="ew-table-header-btn">
		<span class="ew-table-header-caption"><?php echo $tbl_checkstockdetail->DatetimeCreate->caption() ?></span>
		<span class="ew-table-header-sort"><?php if ($tbl_checkstockdetail_preview->SortField == $tbl_checkstockdetail->DatetimeCreate->Name) { ?><?php if ($tbl_checkstockdetail_preview->SortOrder == "ASC") { ?><i class="fa fa-sort-up ew-sort-up"></span><?php } elseif ($tbl_checkstockdetail_preview->SortOrder == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?><?php } ?></span>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tbl_checkstockdetail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$tbl_checkstockdetail_preview->RecCount = 0;
$tbl_checkstockdetail_preview->RowCnt = 0;
while ($tbl_checkstockdetail_preview->Recordset && !$tbl_checkstockdetail_preview->Recordset->EOF) {

	// Init row class and style
	$tbl_checkstockdetail_preview->RecCount++;
	$tbl_checkstockdetail_preview->RowCnt++;
	$tbl_checkstockdetail_preview->CssStyle = "";
	$tbl_checkstockdetail_preview->loadListRowValues($tbl_checkstockdetail_preview->Recordset);
	$tbl_checkstockdetail_preview->aggregateListRowValues(); // Aggregate row values

	// Render row
	$tbl_checkstockdetail_preview->RowType = ROWTYPE_PREVIEW; // Preview record
	$tbl_checkstockdetail_preview->resetAttributes();
	$tbl_checkstockdetail_preview->renderListRow();

	// Render list options
	$tbl_checkstockdetail_preview->renderListOptions();
?>
	<tr<?php echo $tbl_checkstockdetail_preview->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_checkstockdetail_preview->ListOptions->render("body", "left", $tbl_checkstockdetail_preview->RowCnt);
?>
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<!-- Location -->
		<td<?php echo $tbl_checkstockdetail->Location->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->Location->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Location->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td<?php echo $tbl_checkstockdetail->PalletID->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->PalletID->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PalletID->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<!-- Code -->
		<td<?php echo $tbl_checkstockdetail->Code->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->Code->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Code->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td<?php echo $tbl_checkstockdetail->PCS->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->PCS->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->PCS->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<!-- DateTimeCheck -->
		<td<?php echo $tbl_checkstockdetail->DateTimeCheck->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->DateTimeCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DateTimeCheck->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<!-- UserCheck -->
		<td<?php echo $tbl_checkstockdetail->UserCheck->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->UserCheck->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->UserCheck->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<!-- Usercreate -->
		<td<?php echo $tbl_checkstockdetail->Usercreate->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->Usercreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->Usercreate->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<!-- DatetimeCreate -->
		<td<?php echo $tbl_checkstockdetail->DatetimeCreate->cellAttributes() ?>>
<span<?php echo $tbl_checkstockdetail->DatetimeCreate->viewAttributes() ?>>
<?php echo $tbl_checkstockdetail->DatetimeCreate->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$tbl_checkstockdetail_preview->ListOptions->render("body", "right", $tbl_checkstockdetail_preview->RowCnt);
?>
	</tr>
<?php
	$tbl_checkstockdetail_preview->Recordset->MoveNext();
}
?>
	</tbody>
<?php

	// Render aggregate row
	$tbl_checkstockdetail_preview->aggregateListRow(); // Prepare aggregate row

	// Render list options
	$tbl_checkstockdetail_preview->renderListOptions();
?>
	<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options (footer, left)
$tbl_checkstockdetail_preview->ListOptions->render("footer", "left");
?>
<?php if ($tbl_checkstockdetail->Location->Visible) { // Location ?>
		<!-- Location -->
		<td class="<?php echo $tbl_checkstockdetail->Location->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->PalletID->Visible) { // PalletID ?>
		<!-- PalletID -->
		<td class="<?php echo $tbl_checkstockdetail->PalletID->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->Code->Visible) { // Code ?>
		<!-- Code -->
		<td class="<?php echo $tbl_checkstockdetail->Code->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->PCS->Visible) { // PCS ?>
		<!-- PCS -->
		<td class="<?php echo $tbl_checkstockdetail->PCS->footerCellClass() ?>">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $tbl_checkstockdetail->PCS->ViewValue ?></span>
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->DateTimeCheck->Visible) { // DateTimeCheck ?>
		<!-- DateTimeCheck -->
		<td class="<?php echo $tbl_checkstockdetail->DateTimeCheck->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->UserCheck->Visible) { // UserCheck ?>
		<!-- UserCheck -->
		<td class="<?php echo $tbl_checkstockdetail->UserCheck->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->Usercreate->Visible) { // Usercreate ?>
		<!-- Usercreate -->
		<td class="<?php echo $tbl_checkstockdetail->Usercreate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php if ($tbl_checkstockdetail->DatetimeCreate->Visible) { // DatetimeCreate ?>
		<!-- DatetimeCreate -->
		<td class="<?php echo $tbl_checkstockdetail->DatetimeCreate->footerCellClass() ?>">
		&nbsp;
		</td>
<?php } ?>
<?php

// Render list options (footer, right)
$tbl_checkstockdetail_preview->ListOptions->render("footer", "right");
?>
	</tr>
	</tfoot>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<?php } ?>
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php if ($tbl_checkstockdetail_preview->TotalRecs > 0) { ?>
<?php if (!isset($tbl_checkstockdetail_preview->Pager)) $tbl_checkstockdetail_preview->Pager = new PrevNextPager($tbl_checkstockdetail_preview->StartRec, $tbl_checkstockdetail_preview->DisplayRecs, $tbl_checkstockdetail_preview->TotalRecs) ?>
<?php if ($tbl_checkstockdetail_preview->Pager->RecordCount > 0 && $tbl_checkstockdetail_preview->Pager->Visible) { ?>
<div class="ew-pager"><div class="ew-prev-next"><div class="btn-group btn-group-sm ew-btn-group">
<!--first page button-->
	<?php if ($tbl_checkstockdetail_preview->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerFirst") ?>" data-start="<?php echo $tbl_checkstockdetail_preview->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_checkstockdetail_preview->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerPrevious") ?>" data-start="<?php echo $tbl_checkstockdetail_preview->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
<!--next page button-->
	<?php if ($tbl_checkstockdetail_preview->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerNext") ?>" data-start="<?php echo $tbl_checkstockdetail_preview->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_checkstockdetail_preview->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->Phrase("PagerLast") ?>" data-start="<?php echo $tbl_checkstockdetail_preview->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div></div></div>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_checkstockdetail_preview->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_checkstockdetail_preview->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_checkstockdetail_preview->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php } else { ?>
<div class="ew-detail-count"><?php echo $Language->Phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($tbl_checkstockdetail_preview->OtherOptions as &$option)
		$option->render("body");
?>
</div>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
</div><!-- /.card -->
<?php
$tbl_checkstockdetail_preview->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php
if ($tbl_checkstockdetail_preview->Recordset)
	$tbl_checkstockdetail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$tbl_checkstockdetail_preview->terminate();
?>